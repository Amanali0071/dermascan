<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with a Doctor - DermaScan</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <!-- Agora Web SDK (latest version from official CDN) -->
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #incomingCallModal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            text-align: center;
            z-index: 1000;
        }

        /* CSS Variables (Matching Dermascan Theme) */
        :root {
            --primary-color: #08afb4;
            /* Vibrant teal */
            --secondary-color: #08afb4;
            /* Coral accent (corrected from #08afb4) */
            --text-color: #2d3748;
            /* Dark slate */
            --heading-color: #067d81;
            /* Dark slate (corrected from #08afb4 for better contrast) */
            --background-color: #ffffff;
            /* Light background */
            --footer-bg: #2d3748;
            /* Dark slate footer */
            --footer-text: #edf2f7;
            /* Light footer text */
            --card-bg: #ffffff;
            /* White for cards */
            --gradient-start: #e6fffa;
            /* Light teal gradient */
            --chat-bg: #f8fafc;
            /* Light chat background (corrected chat-section background) */
            --message-user-bg: #fff0ba;
            /* User message background (corrected from #08afb4) */
            --message-doctor-bg: #dfedff;
            /* Doctor message background (corrected from #e2e8f0) */
        }

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        /* Header */
        header {
            background-color: var(--background-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            color: var(--primary-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        nav a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 600;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--secondary-color);
        }

        .button {
            border: 2px solid var(--primary-color);
            padding: 8px 15px;
            border-radius: 5px;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .button:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Main Content */
        main {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            color: var(--heading-color);
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 16px;
            color: var(--text-color);
            margin-bottom: 30px;
        }

        /* Doctor Selection */
        .doctor-selection {
            margin-bottom: 40px;
        }

        .doctor-selection h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--heading-color);
            margin-bottom: 20px;
        }

        .doctor-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .doctor-card {
            border: 1px solid #3b8bf5;
            /* Corrected from darkgray for consistency */
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
            width: 200px;
            padding: 15px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .doctor-card:hover {
            transform: scale(1.03);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        }

        .doctor-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .doctor-card h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--heading-color);
            margin-bottom: 5px;
        }

        .doctor-card p {
            font-size: 12px;
            color: var(--text-color);

        }

        .doctor-card.selected {
            border: 2.5px solid rgb(82, 29, 180);
            box-shadow: 0 0 10px rgba(8, 175, 180, 0.3);
            /* background: #f5f7ff; */

        }

        /* Chat Section */
        .chat-section {
            background: white;
            border: 2px solid blueviolet;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 500px;
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
            justify-content: space-between;
            /* Adjusted for call buttons */
        }

        .chat-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--heading-color);
            margin: 0;
        }

        .chat-header p {
            font-size: 14px;
            color: var(--text-color);
            margin: 0;
        }

        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.4;
            position: relative;
            animation: fadeIn 0.5s ease;
        }

        .message.user {
            background-color: var(--message-user-bg);
            /* Corrected to use variable */
            color: #181616;
            /* Adjusted for readability */
            align-self: flex-end;
            border-bottom-right-radius: 5px;
        }

        .message.user::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: -10px;
            width: 0;
            height: 0;
            border: 10px solid transparent;
            border-left-color: var(--message-user-bg);
            border-bottom-color: var(--message-user-bg);
        }

        .message.doctor {
            background-color: var(--message-doctor-bg);
            /* Corrected to use variable */
            color: var(--text-color);
            align-self: flex-start;
            border-bottom-left-radius: 5px;
        }

        .message.doctor::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: -10px;
            width: 0;
            height: 0;
            border: 10px solid transparent;
            border-right-color: var(--message-doctor-bg);
            border-bottom-color: var(--message-doctor-bg);
        }

        .message .timestamp {
            font-size: 10px;
            color: #a0aec0;
            margin-top: 5px;
            display: block;
        }

        .chat-footer {
            display: flex;
            gap: 10px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            align-items: center;
        }

        .upload-button {
            cursor: pointer;
            padding: 10px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .upload-button:hover {
            background-color: #0a969a;
        }

        .chat-footer input[type="text"] {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chat-footer button {
            padding: 10px 20px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .chat-footer button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .typing {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 10px;
            background-color: var(--message-doctor-bg);
            border-radius: 15px;
            align-self: flex-start;
        }

        .typing-dots {
            display: flex;
            gap: 5px;
        }

        .typing-dots span {
            width: 8px;
            height: 8px;
            background-color: #a0aec0;
            border-radius: 50%;
            animation: typing 1s infinite;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        /* Call Buttons */
        .call-buttons {
            display: none;
            gap: 10px;
        }

        .call-buttons button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .call-buttons button:hover {
            background-color: #0a969a;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .call-buttons button {
                width: 35px;
                height: 35px;
            }

            main {
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            .doctor-card {
                width: 150px;
            }

            .doctor-card img {
                width: 80px;
                height: 80px;
            }

            .chat-section {
                height: 400px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes typing {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* Footer */
        footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 40px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .footer-links {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .column {
            min-width: 200px;
        }

        .column h3 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .column ul {
            list-style: none;
            padding: 0;
        }

        .column a {
            color: var(--footer-text);
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin: 5px 0;
            transition: color 0.3s ease;
        }

        .column a:hover {
            color: var(--secondary-color);
        }

        .footer-info {
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }

        .footer-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .footer-info a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-info a:hover {
            color: var(--secondary-color);
        }

        .social-media {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .social-media a {
            color: var(--footer-text);
            font-size: 26px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: var(--secondary-color);
        }
    </style>
</head>

<body>
    @include('call.index')
    <!-- Header -->
    <header>
        <a href="{{ url('/') }}" style="text-decoration: none;">
            <div class="logo">DERMASCAN</div>
        </a>
        <nav>
            <ul>
                <li><a href="{{ route('getcheck') }}">Get checked</a></li>
                <li><a href="{{ route('aboutus') }}">About us</a></li>
                <li><a href="{{ route('skinguide') }}">Skin Guide</a></li>
                <li><a href="{{ route('research') }}">Research</a></li>
                <li><a href="{{ route('contactus') }}">contact us</a></li>
                <li><a href="{{ route('pharmacy') }}"><i class="fas fa-capsules"
                            style="margin-right: 7px;"></i>Pharmacy</a></li>
                <li><a href="{{ route('login') }}" class="button2"><i class="fas fa-user"></i></a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h1>Chat with a Doctor</h1>
        <p class="subtitle">Connect with our expert dermatologists for personalized advice.</p>

        <!-- Doctor Selection -->
        <section class="doctor-selection">
            <h2>Select a Dermatologist</h2>
            <div class="doctor-list">
                @foreach ($doctors as $doctor)
                    <div class="doctor-card" data-id="{{ @$doctor->user_id }}"
                        data-name="{{ @$doctor->user->first_name ?? 'Anonymous Doctor' }}"
                        data-image="{{ asset('uploads/' . $doctor->user_image) ?? 'https://static.vecteezy.com/system/resources/previews/046/680/020/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png' }}">
                        <img src="{{ asset('uploads/' . $doctor->user_image) ?? 'https://static.vecteezy.com/system/resources/previews/046/680/020/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png' }}"
                            alt="Prof. Dr. Ikram Ullah Khan">
                        <h3>{{ @$doctor->user->first_name ?? 'Anonymous Doctor' }}</h3>
                        <p>{{ @$doctor->specialization ?? '' }}</p>
                    </div>
                @endforeach
                <div class="doctor-card" data-name="Dr. Nusrat Ali Shaikh"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/061/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/061/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Nusrat Ali Shaikh">
                    <h3>Dr. Nusrat Ali Shaikh</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Syed Ghulam Shabbir"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/043/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/043/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Syed Ghulam Shabbir">
                    <h3>Dr. Syed Ghulam Shabbir</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Syed Muhammad Jaffer"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/182/non_2x/an-pakistani-male-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/182/non_2x/an-pakistani-male-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Syed Muhammad Jaffer">
                    <h3>Dr. Syed Muhammad Jaffer</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Mahboob Ahmad"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/179/original/an-pakistani-male-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/179/original/an-pakistani-male-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Mahboob Ahmad">
                    <h3>Dr. Mahboob Ahmad</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Dur-e-Kamil"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/018/original/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/018/original/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Dur-e-Kamil">
                    <h3>Dr. Dur-e-Kamil</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Prof. Tahir Saeed Haroon"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/045/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/045/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png"
                        alt="Prof. Tahir Saeed Haroon">
                    <h3>Prof. Tahir Saeed Haroon</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Ashfaq Ahmad Khan"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/025/original/an-pakistani-male-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/025/original/an-pakistani-male-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Ashfaq Ahmad Khan">
                    <h3>Dr. Ashfaq Ahmad Khan</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Sabrina Suhail"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/092/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/092/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Sabrina Suhail">
                    <h3>Dr. Sabrina Suhail</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Qurat ul ain Sajida"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/079/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/079/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Qurat ul ain Sajida">
                    <h3>Dr. Qurat ul ain Sajida</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Ayesha Rehman"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/089/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/089/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Ayesha Rehman">
                    <h3>Dr. Ayesha Rehman</h3>
                    <p>Dermatologist</p>
                </div>
                <div class="doctor-card" data-name="Dr. Syeda Summaya Jamal"
                    data-image="https://static.vecteezy.com/system/resources/previews/046/680/104/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/104/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png"
                        alt="Dr. Syeda Summaya Jamal">
                    <h3>Dr. Syeda Summaya Jamal</h3>
                    <p>Dermatologist</p>
                </div>
            </div>
        </section>

        <!-- Chat Section -->
        <div id="local-player" style="width: 100%; height: 50vh; background-color: black;"></div>
        <div id="remote-player" style="width: 100%; height: 50vh; background-color: black;"></div>
        <section class="chat-section" id="chat-section">
            <div class="chat-header">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="{{ asset('web/media/avatars/male.png') }}" alt="Doctor">
                    <div>
                        <h3>Start Chat</h3>
                        <p></p>
                    </div>
                </div>
                <div class="call-buttons">
                    <button id="audioCallButton" class="call-audio-btn" title="Start Audio Call"><i
                            class="fas fa-phone"></i></button>
                    <button id="videoCallButton" class="call-btn" title="Start Video Call"><i
                            class="fas fa-video"></i></button>
                </div>
            </div>
            <div class="chat-body" id="chatBody">
                <div class="message doctor">
                    Hello! How can I assist you today with your skin concerns?
                    <span class="timestamp">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit'
                        })}</span>
                </div>
            </div>
            <div class="chat-footer">
                <label for="fileInput" class="upload-button"><i class="fas fa-paperclip"></i></label>
                <input type="file" id="fileInput" style="display: none;" accept="image/*">
                {{-- <button id="voiceMessageButton" class="upload-button" title="Record Voice Message"><i
                        class="fas fa-microphone"></i></button> --}}
                <input type="text" id="chatInput" placeholder="Type your message...">
                <button id="sendButton">Send</button>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <div class="column">
                <h3>The Company</h3>
                <ul>
                    <li><a href="#">Send a Case</a></li>
                    <li><a href="#">Review Your Case</a></li>
                    <li><a href="#">The Team</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Get Involved</h3>
                <ul>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Partnerships</a></li>
                    <li><a href="#">Spot Cancer</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Skin Image Search</a></li>
                    <li><a href="#">Partner Program</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-info">
            <p>DermaScan Ai</p>
            <p></p>
            <p>
                <a href="#">Terms & Conditions</a> -
                <a href="#">Website Terms of Use</a>
            </p>
            <p>
                <a href="#">Privacy Notice</a> -
                <a href="#">Privacy Shield</a> -
                <a href="#">Terms & Conditions Autoderm</a>
            </p>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/twitter?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- Laravel Echo using CDN -->
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.js"></script>
    <script>
        window.Pusher = Pusher;
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true,
            encrypted: true,
        });
    </script>
    <script>
        const doctorCards = document.querySelectorAll('.doctor-card');
        const chatHeaderImg = document.querySelector('.chat-header img');
        const chatHeaderName = document.querySelector('.chat-header h3');
        const chatBody = document.getElementById('chatBody');
        const chatInput = document.getElementById('chatInput');
        const sendButton = document.getElementById('sendButton');
        const fileInput = document.getElementById('fileInput');
        const audioCallButton = document.getElementById('audioCallButton');
        const videoCallButton = document.getElementById('videoCallButton');
        const voiceMessageButton = document.getElementById('voiceMessageButton');
        //auth user check 

        let selectedDoctorId = null;
        let currentChannel = null;
        const currentUserId = '{{ auth()->id() }}';

        function addMessage(content, type = 'user', isElement = false) {
            const message = document.createElement('div');
            message.classList.add('message', type);

            if (isElement) {
                message.appendChild(content);
            } else {
                message.innerHTML = content;
            }

            const timestamp = document.createElement('span');
            timestamp.classList.add('timestamp');
            timestamp.textContent = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
            message.appendChild(timestamp);

            chatBody.appendChild(message);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function createMessageElement(content, type) {
            const message = document.createElement('div');
            message.classList.add('message', type);

            const timestamp = document.createElement('span');
            timestamp.classList.add('timestamp');
            timestamp.textContent = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });

            message.appendChild(content);
            message.appendChild(timestamp);

            return message;
        }

        function createImageElement(imageSrc) {
            const img = document.createElement('img');
            img.src = imageSrc;
            img.style.maxWidth = '200px';
            img.style.borderRadius = '10px';
            return img;
        }


        doctorCards.forEach(card => {
            card.addEventListener('click', () => {
                const chatModal = document.getElementById('chat-section');
                setTimeout(() => {
                    chatModal.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 100);
                if (currentUserId == '' || currentUserId == null || currentUserId == undefined) {
                    location.href = '/login';
                    return;
                }
                document.querySelector('.call-buttons').style.display = 'flex';
                let callbtn = document.querySelector('.call-btn');
                callbtn.setAttribute('data-user-id', card.getAttribute('data-id'));
                let callAudibtn = document.querySelector('.call-audio-btn');
                callAudibtn.setAttribute('data-user-id', card.getAttribute('data-id'));
                doctorCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                const name = card.getAttribute('data-name');
                const docId = card.getAttribute('data-id');
                const image = card.getAttribute('data-image');
                selectedDoctorId = docId;
                chatHeaderImg.src = image;
                chatHeaderName.textContent = name;
                chatBody.innerHTML = `<div class="message doctor">
                    Hello! How can I assist you today with your skin concerns?
                    <span class="timestamp">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
                </div>`;
                fetch(`/doctor/chat/history/${docId}`)
                    .then(res => res.json())
                    .then(messages => {
                        chatBody.innerHTML = '';
                        messages.forEach(msg => {
                            if (msg.message || msg.image) {
                                let messageElement;

                                if (msg.sender_id == currentUserId) {
                                    if (msg.image) {
                                        const img = createImageElement(
                                            `{{ asset('uploads/messagesImgs/') }}/${msg.image}`
                                        );
                                        messageElement = createMessageElement(img, 'user');
                                    } else {
                                        addMessage(msg.message, 'user');
                                    }
                                } else if (msg.sender_id == docId && msg.receiver_id ==
                                    currentUserId) {
                                    if (msg.image) {
                                        const img = createImageElement(
                                            `{{ asset('uploads/messagesImgs/') }}/${msg.image}`
                                        );
                                        messageElement = createMessageElement(img, 'doctor');
                                    } else {
                                        addMessage(msg.message, 'doctor');
                                    }
                                } else {
                                    if (msg.image) {
                                        const img = createImageElement(
                                            `{{ asset('uploads/messagesImgs/') }}/${msg.image}`
                                        );
                                        messageElement = createMessageElement(img, 'doctor');
                                    } else {
                                        addMessage(msg.message, 'doctor');
                                    }
                                }

                                if (messageElement) {
                                    chatBody.appendChild(messageElement);
                                }
                            }
                        });
                    });

                if (currentChannel) {
                    currentChannel.unbind_all();
                    window.Echo.leave(currentChannel.name);
                }

                const channelName = `user.${currentUserId}`;
                var pusher = new Pusher('08c43c7217d98c7f6c1e', {
                    cluster: 'ap2'
                });
                var channel = pusher.subscribe(channelName);
                channel.bind('new-message', function(data) {
                    if (data.sender_id == currentUserId) {
                        addMessage(data.message.message, 'user');
                    } else if (data.sender_id == docId && data.receiver_id == currentUserId) {
                        addMessage(data.message.message, 'doctor');
                    } else {
                        addMessage(data.message.message, 'doctor');
                    }

                });

            });
        });

        function sendMessage() {
            const messageText = chatInput.value.trim();
            if (!messageText || !selectedDoctorId) return;

            addMessage(messageText, 'user');
            chatInput.value = '';

            axios.post('/send-message', {
                receiver_id: selectedDoctorId,
                message: messageText
            });
        }

        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '200px';
                    img.style.borderRadius = '10px';
                    addMessage(img, 'user', true);

                    // Create FormData to send the image file along with the message
                    const formData = new FormData();
                    formData.append('receiver_id', selectedDoctorId);
                    formData.append('image_file', file);
                    axios.post('/send-message', formData)
                        .then(response => {
                            console.log('Image sent successfully:', response.data);
                        })
                        .catch(error => {});
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        // Voice Message Recording
        let mediaRecorder;
        let audioChunks = [];

        voiceMessageButton.addEventListener('click', async () => {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('Your browser does not support audio recording.');
                return;
            }

            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    audio: true
                });
                mediaRecorder = new MediaRecorder(stream);
                audioChunks = [];

                mediaRecorder.ondataavailable = (event) => {
                    audioChunks.push(event.data);
                };

                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, {
                        type: 'audio/webm'
                    });
                    const audioUrl = URL.createObjectURL(audioBlob);
                    const audio = document.createElement('audio');
                    audio.controls = true;
                    audio.src = audioUrl;
                    addMessage(audio, 'user', true);
                    stream.getTracks().forEach(track => track.stop()); // Stop the microphone
                    simulateDoctorResponse();
                };

                // Toggle recording state
                if (mediaRecorder.state === 'inactive') {
                    mediaRecorder.start();
                    voiceMessageButton.style.backgroundColor = '#ff6f61'; // Indicate recording
                    voiceMessageButton.innerHTML = '<i class="fas fa-stop"></i>';
                } else {
                    mediaRecorder.stop();
                    voiceMessageButton.style.backgroundColor = '#08afb4'; // Reset color
                    voiceMessageButton.innerHTML = '<i class="fas fa-microphone"></i>';
                }
            } catch (err) {
                console.error('Error accessing microphone:', err);
                alert('Failed to access microphone. Please check permissions.');
            }
        });
    </script>
</body>

</html>
