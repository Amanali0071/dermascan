<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Call UI Styles */
        .call-containers {
            display: flex;
            position: fixed;
            z-index: 10000;
            width: 100%;
            height: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            gap: 5px;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
        }
                #local-player,
        #remote-player {
            width: 100%;
            height: 50vh;
            background-color: black;
            display: none;
        }

        #incomingCallModal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #000;
            color: #fff;
            padding: 30px;
            text-align: center;
            z-index: 1000;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        .caller-image-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px auto;
            border: 3px solid #3498db;
        }

        .caller-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .call-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .call-button:hover {
            transform: scale(1.05);
        }

        .answer-button {
            background-color: #2ecc71;
        }

        .reject-button {
            background-color: #e74c3c;
        }

        #callContainer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            display: none;
        }

        .call-controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 1001;
        }

        .control-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-button:hover {
            transform: scale(1.1);
        }

        #local-player {
            width: 25%;
            height: 25%;
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 1001;
            border: 2px solid white;
            border-radius: 10px;
            overflow: hidden;
            background: #000;
        }

        #remote-player {
            width: 100%;
            height: 100%;
        }

        #call-timer {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            font-size: 18px;
            z-index: 1001;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px 15px;
            border-radius: 20px;
        }
        .agora_video_player{
            position: fixed !important;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            #local-player {
                width: 30%;
                height: 20%;
            }

            .call-controls {
                bottom: 20px;
            }

            .control-button {
                width: 45px;
                height: 45px;
            }
        }

        @media (max-width: 480px) {
            #local-player {
                width: 35%;
                height: 15%;
            }

            .call-controls {
                gap: 10px;
            }

            .control-button {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            #incomingCallModal {
                width: 250px;
                padding: 20px;
            }

            .caller-image-container {
                width: 80px;
                height: 80px;
            }

            .call-button {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Video Call Modals -->
    <div id="incomingCallModal"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #000; color:#fff; padding: 30px; text-align: center; z-index: 1000; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.3); width: 300px;">
        <div class="text-center">
            <div
                style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 15px auto; border: 3px solid #3498db;">
                <img src="{{ asset('frontend/images/doctoravatar.jpg') }}" class="caller-image"
                    style="width: 100%; height: 100%; object-fit: cover;" alt="Caller">
            </div>
            <h4 style="margin-bottom: 5px; font-weight: 600;">Incoming Video Call</h4>
            <p class="caller-name" style="margin-bottom: 20px; color: #555;"></p>
            <div style="display: flex; justify-content: center; gap: 20px;">
                <button id="answerCall"
                    style="width: 60px; height: 60px; border-radius: 50%; background-color: #2ecc71; border: none; color: white; font-size: 24px; cursor: pointer; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <i class="fas fa-phone"></i>
                </button>
                <button id="rejectCall"
                    style="width: 60px; height: 60px; border-radius: 50%; background-color: #e74c3c; border: none; color: white; font-size: 24px; cursor: pointer; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <div id="incomingAudioCallModal"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #000; color:#fff; padding: 30px; text-align: center; z-index: 1000; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.3); width: 300px;">
        <div class="text-center">
            <div
                style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 15px auto; border: 3px solid #3498db;">
                <img src="{{ asset('frontend/images/doctoravatar.jpg') }}" class="caller-image"
                    style="width: 100%; height: 100%; object-fit: cover;" alt="Caller">
            </div>
            <h4 style="margin-bottom: 5px; font-weight: 600;">Incoming Audio Call</h4>
            <p class="caller-name" style="margin-bottom: 20px; color: #555;"></p>
            <div style="display: flex; justify-content: center; gap: 20px;">
                <button id="answerAudioCall"
                    style="width: 60px; height: 60px; border-radius: 50%; background-color: #2ecc71; border: none; color: white; font-size: 24px; cursor: pointer; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <i class="fas fa-phone"></i>
                </button>
                <button id="rejectAudioCall"
                    style="width: 60px; height: 60px; border-radius: 50%; background-color: #e74c3c; border: none; color: white; font-size: 24px; cursor: pointer; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="callContainer"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); z-index: 1000;">
        <div
            style="position: absolute; top: 95%; right: 50%; transform: translate(-95%,-50%); z-index: 1001; display: flex; gap: 10px;">
            <button id="endCallBtn"
                style="width: 50px; height: 50px; border-radius: 50%; background-color: #e74c3c; border: none; color: white; font-size: 20px; cursor: pointer;">
                <i class="fas fa-phone-slash"></i>
            </button>
        </div>
        <div id="call-timer"
            style="position: absolute; top: 20px; left: 20px; color: white; font-size: 18px; z-index: 1001; background-color: rgba(0,0,0,0.5); padding: 5px 15px; border-radius: 20px;">
            {{-- 00:00 --}}
        </div>
        <div id="local-player"
            style="width: 35%; height: 45%; position: absolute; bottom: 20px; right: 20px; z-index: 1001; border: 2px solid white; border-radius: 10px; overflow: hidden;">
        </div>
        <div id="remote-player" style="width: 100%; height: 100%;"></div>
    </div>
    <div id="audioCallContainer"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); z-index: 1000;">
        <!-- Call Timer -->
        <!-- Main Content - Avatar and Call Status -->
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
            <!-- User avatar -->
            <div style="margin-bottom: 30px;">
                <div class="avatar-container"
                    style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; border: 3px solid #4CAF50; overflow: hidden; background-color: #f0f0f0;">
                    <img id="remoteUserAvatar" src="{{ $receiver->profile_photo_url ?? asset('frontend/images/doctoravatar.jpg') }}"
                        alt="User Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>

            <!-- Call status indicator -->
            <div id="callStatusIndicator" style="background:#000; color: white; font-size: 18px; margin-top: 10px;">
                <div id="incomingCallStatus" style="display: none;">
                    <p>Incoming audio call...</p>
                    <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                        <button id="acceptAudioCallBtn"
                            style="width: 60px; height: 60px; border-radius: 50%; background-color: #4CAF50; border: none; color: white; font-size: 20px; cursor: pointer;">
                            <i class="fas fa-phone"></i>
                        </button>
                        <button id="rejectAudioCallBtn"
                            style="width: 60px; height: 60px; border-radius: 50%; background-color: #e74c3c; border: none; color: white; font-size: 20px; cursor: pointer;">
                            <i class="fas fa-phone-slash"></i>
                        </button>
                    </div>
                </div>
                <div id="callingStatus">
                    <p>Calling...</p>
                    <div class="calling-animation" style="margin-top: 15px;">
                        <span
                            style="display: inline-block; width: 10px; height: 10px; background-color: #4CAF50; border-radius: 50%; margin: 0 5px; animation: pulse 1.5s infinite ease-in-out;"></span>
                        <span
                            style="display: inline-block; width: 10px; height: 10px; background-color: #4CAF50; border-radius: 50%; margin: 0 5px; animation: pulse 1.5s infinite ease-in-out 0.3s;"></span>
                        <span
                            style="display: inline-block; width: 10px; height: 10px; background-color: #4CAF50; border-radius: 50%; margin: 0 5px; animation: pulse 1.5s infinite ease-in-out 0.6s;"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call Controls -->
        <div
            style="position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); display: flex; gap: 20px;">
            <button id="endAudioCallBtn"
                style="width: 60px; height: 60px; border-radius: 50%; background-color: #e74c3c; border: none; color: white; font-size: 20px; cursor: pointer;">
                <i class="fas fa-phone-slash"></i>
            </button>
        </div>
    </div>
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js" defer></script>

    <script>
        function loadAgoraSDK() {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = 'https://cdn.agora.io/sdk/release/AgoraRTC_N-4.17.2.js';
                script.onload = () => resolve();
                script.onerror = () => reject(new Error('Failed to load Agora SDK'));
                document.head.appendChild(script);
            });
        }

        // Wait for DOM to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Load the Agora SDK
            loadAgoraSDK()
                .then(() => {
                    console.log('Agora SDK loaded successfully');

                    // Initialize Agora client - ONLY after SDK is loaded
                    const APP_ID = "{{ env('AGORA_APP_ID') }}";
                    const client = AgoraRTC.createClient({
                        mode: "rtc",
                        codec: "vp8"
                    });
                    let localTracks = [];
                    let remoteTracks = {};

                    // Pusher setup
                    const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                        cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
                        encrypted: true
                    });

                    const channel = pusher.subscribe(`user.{{ auth()->id() }}`);

                    channel.bind('incoming-call', (data) => {
                        // console.log('Incoming call:', data);
                        document.getElementById('incomingCallModal').style.display = 'block';
                        document.querySelector('.caller-name').innerText = data.caller.name;

                        document.getElementById('answerCall').addEventListener('click', () => {
                            startReceiverVideoCall(data.channel_name);
                            document.getElementById('incomingCallModal').style.display = 'none';
                        });

                        document.getElementById('rejectCall').addEventListener('click', () => {
                            document.getElementById('incomingCallModal').style.display = 'none';
                        });
                    });
                    channel.bind('incoming-audio-call', (data) => {
                        // console.log('Incoming call:', data);
                        document.getElementById('incomingAudioCallModal').style.display = 'block';
                        document.querySelector('.caller-name').innerText = data.caller.name;

                        document.getElementById('answerAudioCall').addEventListener('click', () => {
                            startReceiverAudioCall(data.channel_name);
                            document.getElementById('incomingAudioCallModal').style.display =
                                'none';
                        });

                        document.getElementById('rejectAudioCall').addEventListener('click', () => {
                            document.getElementById('incomingAudioCallModal').style.display =
                                'none';
                        });
                    });

                    document.querySelectorAll('.call-btn').forEach(button => {
                        button.addEventListener('click', async (event) => {
                            // console.log('Call button clicked:', event.target.closest('.call-btn').dataset.userId);
                            const recipientId = event.target.closest('.call-btn').dataset
                                .userId;
                            const channelName =
                                `call_{{ auth()->id() }}_${recipientId}_${Date.now()}`;

                            await startCallerVideoCall(channelName);

                            const response = await fetch("{{ route('call.initiate') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({
                                    recipient_id: recipientId,
                                    channel_name: channelName,
                                })
                            });

                            const data = await response.json();
                            // console.log('Call initiated:', data.channel_name);
                        });
                    });

                    document.querySelectorAll('.call-audio-btn').forEach(button => {
                        button.addEventListener('click', async (event) => {
                            const recipientId = event.target.closest('.call-audio-btn')
                                .dataset
                                .userId;
                            const channelName =
                                `call_{{ auth()->id() }}_${recipientId}_${Date.now()}`;

                            await startCallerAudioCall(channelName);

                            const response = await fetch("{{ route('call.initiate') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({
                                    recipient_id: recipientId,
                                    channel_name: channelName,
                                    calltype: 'audio',
                                })
                            });

                            const data = await response.json();
                        });
                    });

                    // Define your video call functions within this scope
                    async function startCallerVideoCall(channelName) {
                        try {
                            const tokenResponse = await fetch("{{ route('call.token') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({
                                    channel_name: channelName,
                                    uid: "{{ auth()->id() }}",
                                })
                            });

                            const tokenData = await tokenResponse.json();
                            const token = tokenData.token;

                            await client.join(APP_ID, channelName, token, "{{ auth()->id() }}");

                            const localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                            const localVideoTrack = await AgoraRTC.createCameraVideoTrack();
                            localTracks.push(localAudioTrack, localVideoTrack);
                            document.querySelector('#callContainer').style.display = 'block';
                            localVideoTrack.play("local-player");
                            await client.publish(localTracks);

                            client.on("user-published", async (user, mediaType) => {
                                // Subscribe to the remote user's media
                                await client.subscribe(user, mediaType);

                                // Handle video track
                                if (mediaType === "video") {
                                    const remoteVideoTrack = user.videoTrack;
                                    if (remoteVideoTrack) {
                                        // console.log("Playing remote video for user:", user.uid);
                                        remoteVideoTrack.play("remote-player");
                                    } else {
                                        console.error("No video track found for user:", user
                                            .uid);
                                    }
                                }

                                // Handle audio track
                                if (mediaType === "audio") {
                                    const remoteAudioTrack = user.audioTrack;
                                    if (remoteAudioTrack) {
                                        console.log("Playing remote audio for user:", user.uid);
                                        remoteAudioTrack.play();
                                    } else {
                                        console.error("No audio track found for user:", user
                                            .uid);
                                    }
                                }
                            });                            
                            document.getElementById('local-player').style.display = 'block';
                            // document.querySelector('#local-player video').style.position = 'absolute !important'; 
                            document.querySelector('.agora_video_player').setAttribute('style', 'display: block !important; position: absolute !important; object-fit:cover; width:100%; height:100%;');
                           
                            document.getElementById('remote-player').style.display = 'block';
                            // Handle other connection events
                            client.on("connection-state-change", (curState, prevState) => {
                                console.log(
                                    `Connection state changed from ${prevState} to ${curState}`);
                            });
                        } catch (error) {
                            console.error("Error in startCallerVideoCall:", error);
                        }
                    }

                    async function startReceiverVideoCall(newChannelName) {
                        try {
                            // Fetch token for receiver
                            const tokenResponse = await fetch("{{ route('call.token') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({
                                    channel_name: newChannelName,
                                    uid: "{{ auth()->id() }}",
                                }),
                            });

                            if (!tokenResponse.ok) {
                                throw new Error('Network response was not ok');
                            }

                            const tokenData = await tokenResponse.json().catch(error => {
                                console.error('Error parsing JSON:', error);
                                return {};
                            });
                            const newToken2 = tokenData.token;
                            // Join the channel
                            await client.join(APP_ID, newChannelName, newToken2,
                                "{{ auth()->id() }}");

                            // Log channel name
                            console.log("Joined channel:", newChannelName);

                            // Listen for remote users publishing streams
                            client.on("user-published", async (user, mediaType) => {
                                console.log("Remote user published:", user.uid);

                                // Subscribe to the remote user's media
                                await client.subscribe(user, mediaType);

                                // Handle video track
                                if (mediaType === "video") {
                                    const newRemoteVideoTrack = user.videoTrack;
                                    if (newRemoteVideoTrack) {
                                        // console.log("Playing remote video for user:", user.uid);
                                        newRemoteVideoTrack.play(
                                            "remote-player"
                                        ); // Update with your remote player container ID
                                    } else {
                                        console.error("No video track found for user:", user
                                            .uid);
                                    }
                                }

                                // Handle audio track
                                if (mediaType === "audio") {
                                    const newRemoteAudioTrack = user.audioTrack;
                                    if (newRemoteAudioTrack) {
                                        console.log("Playing remote audio for user:", user.uid);
                                        newRemoteAudioTrack.play();
                                    } else {
                                        console.error("No audio track found for user:", user
                                            .uid);
                                    }
                                }
                            });

                            // Handle other connection events
                            client.on("connection-state-change", (curState, prevState) => {
                                console.log(
                                    `Connection state changed from ${prevState} to ${curState}`);
                            });

                            const newLocalAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                            const newLocalVideoTrack = await AgoraRTC.createCameraVideoTrack();
                            newLocalTracks.push(newLocalAudioTrack, newLocalVideoTrack);

                            newLocalVideoTrack.play("local-player");
                            await client.publish(newLocalTracks);
                            document.querySelector('#callContainer').setAttribute('style', 'display: block !important;');
                            document.getElementById('local-player').style.display = 'block';
                            document.getElementById('remote-player').style.display = 'block';
                        } catch (error) {
                            console.error("Error in startNewReceiverVideoCall:", error);
                        }
                    }

                    async function startCallerAudioCall(channelName) {
                        try {
                            const tokenResponse = await fetch("{{ route('call.token') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({
                                    channel_name: channelName,
                                    uid: "{{ auth()->id() }}",
                                })
                            });

                            const tokenData = await tokenResponse.json();
                            const token = tokenData.token;

                            await client.join(APP_ID, channelName, token, "{{ auth()->id() }}");
                            document.querySelector('#audioCallContainer').style.display = 'block';
                            const localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                            localTracks.push(localAudioTrack);

                            // Publish only audio track
                            await client.publish(localAudioTrack);

                            client.on("user-published", async (user, mediaType) => {
                                // Subscribe to the remote user's media
                                await client.subscribe(user, mediaType);

                                // Handle audio track
                                if (mediaType === "audio") {
                                    const remoteAudioTrack = user.audioTrack;
                                    if (remoteAudioTrack) {
                                        console.log("Playing remote audio for user:", user.uid);
                                        remoteAudioTrack.play();
                                    } else {
                                        console.error("No audio track found for user:", user
                                            .uid);
                                    }
                                }
                            });

                            // Handle other connection events
                            client.on("connection-state-change", (curState, prevState) => {
                                console.log(
                                    `Connection state changed from ${prevState} to ${curState}`);
                            });
                        } catch (error) {
                            console.error("Error in startCallerAudioCall:", error);
                        }
                    }

                    async function startReceiverAudioCall(newChannelName) {
                        try {
                            // Fetch token for receiver
                            const tokenResponse = await fetch("{{ route('call.token') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                body: JSON.stringify({
                                    channel_name: newChannelName,
                                    uid: "{{ auth()->id() }}",
                                }),
                            });

                            if (!tokenResponse.ok) {
                                throw new Error('Network response was not ok');
                            }

                            const tokenData = await tokenResponse.json().catch(error => {
                                console.error('Error parsing JSON:', error);
                                return {};
                            });
                            const newToken2 = tokenData.token;

                            // Join the channel
                            await client.join(APP_ID, newChannelName, newToken2, "{{ auth()->id() }}");

                            // Log channel name
                            console.log("Joined channel:", newChannelName);

                            // Listen for remote users publishing streams
                            client.on("user-published", async (user, mediaType) => {
                                console.log("Remote user published:", user.uid);

                                // Subscribe to the remote user's media
                                await client.subscribe(user, mediaType);

                                // Handle audio track
                                if (mediaType === "audio") {
                                    const newRemoteAudioTrack = user.audioTrack;
                                    if (newRemoteAudioTrack) {
                                        console.log("Playing remote audio for user:", user.uid);
                                        newRemoteAudioTrack.play();
                                    } else {
                                        console.error("No audio track found for user:", user
                                            .uid);
                                    }
                                }
                            });

                            // Handle other connection events
                            client.on("connection-state-change", (curState, prevState) => {
                                console.log(
                                    `Connection state changed from ${prevState} to ${curState}`);
                            });

                            const newLocalAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                            newLocalTracks.push(newLocalAudioTrack);

                            // Publish only audio track
                            await client.publish(newLocalAudioTrack);
                        } catch (error) {
                            console.error("Error in startReceiverAudioCall:", error);
                        }
                    }
                })
                .catch((error) => {
                    console.error('Error loading Agora SDK:', error);
                });
        });
        document.getElementById('endCallBtn').addEventListener('click', function() {
            document.getElementById('callContainer').style.display = 'none';
            location.reload();
        });
    </script>
</body>

</html>
