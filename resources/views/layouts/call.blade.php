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
                    console.log('Incoming call:', data);
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

                document.querySelectorAll('.call-btn').forEach(button => {
                    button.addEventListener('click', async (event) => {
                        console.log('Call button clicked:', event.target.closest(
                            '.call-btn').dataset.userId);
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
                        console.log('Call initiated:', data.channel_name);
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

                        localVideoTrack.play("local-player");
                        await client.publish(localTracks);

                        client.on("user-published", async (user, mediaType) => {
                            console.log("Remote user published:", user.uid);

                            // Subscribe to the remote user's media
                            await client.subscribe(user, mediaType);

                            // Handle video track
                            if (mediaType === "video") {
                                const remoteVideoTrack = user.videoTrack;
                                if (remoteVideoTrack) {
                                    console.log("Playing remote video for user:", user.uid);
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
                                    console.log("Playing remote video for user:", user.uid);
                                    newRemoteVideoTrack.play(
                                        "call-remote-player"
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

                        newLocalVideoTrack.play("call-local-player");
                        await client.publish(newLocalTracks);
                    } catch (error) {
                        console.error("Error in startNewReceiverVideoCall:", error);
                    }
                }

                // Make the local-player and remote-player elements visible
                document.getElementById('local-player').style.display = 'block';
                document.getElementById('remote-player').style.display = 'block';
            })
            .catch((error) => {
                console.error('Error loading Agora SDK:', error);
            });
    });
</script>
