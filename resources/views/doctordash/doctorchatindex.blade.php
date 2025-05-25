@extends('layouts.app')

@section('title')
    {{ __('Patient Chat') }}
@endsection

@section('content')
    <style>
        .patient-card {
            width: 200px;
            height: 200px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 1rem;
            margin: 1rem;
            transition: 0.3s;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #003366;
            color: white;
        }

        .patient-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .chat-modal {
            position: fixed;
            bottom: 0;
            right: 20px;
            width: 400px;
            height: 500px;
            background: #fff;
            border-radius: 12px 12px 0 0;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            z-index: 1050;
        }

        .chat-modal-header,
        .chat-modal-footer {
            padding: 10px 15px;
            background-color: #003366;
            color: white;
        }

        .chat-modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: #f1f1f1;
        }

        .chat-message {
            background: #fff;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            max-width: 55%;
        }

        .chat-modal-footer {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-modal-footer input {
            flex: 1;
            border-radius: 20px;
            border: 1px solid #ccc;
            padding: 6px 12px;
        }

        .close-chat {
            cursor: pointer;
            color: #ccc;
            font-size: 18px;
        }
    </style>

    <div class="container-fluid d-flex flex-wrap">
        @foreach ($messages as $userId => $chatGroup)
            @php
                $user = \App\Models\User::find($userId);
            @endphp
            <div class="patient-card"
                onclick="openChat('{{ 'uploads/' . $user->user_image ?? '/default-avatar.png' }}','{{ $user->first_name }}', {{ $user->id }})">
                <img src="{{ 'uploads/' . $user->user_image ?? '/default-avatar.png' }}" alt="Patient">
                <div>{{ $user->first_name }}</div>
            </div>
        @endforeach
    </div>


    <!-- Chat Modal -->
    <div class="chat-modal d-none" id="chatModal">
        <div class="chat-modal-header d-flex justify-content-between align-items-center">
            <div class="">
                <img style="width: 40px; height: 40px; border-radius: 50%;" id="chatPatientImg"
                    src="{{ '/default-avatar.png' }}" alt="">
                <strong id="chatPatientName">Chat</strong>
            </div>
            <span class="close-chat" onclick="closeChat()">&times;</span>
        </div>
        <div class="chat-modal-body" id="chatMessages">
            <!-- Messages appear here -->
        </div>
        <div class="chat-modal-footer">
            <input type="text" id="chatInput" placeholder="Type a message..." onkeydown="handleEnter(event)">
            <button class="btn btn-light" onclick="sendMessage()">Send</button>
        </div>
    </div>

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
        const currentUserId = {{ auth()->id() }};
        const channelName = `user.${currentUserId}`;
        var pusher = new Pusher('08c43c7217d98c7f6c1e', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe(channelName);
        channel.bind('new-message', function(data) {
            const chatMessages = document.getElementById('chatMessages');
            if (currentChatUserId == data.message.sender_id) {
                const msgDiv = document.createElement('div');
                msgDiv.className = 'chat-message bg-light';
                msgDiv.innerText = `${data.sender_name}: ${data.message.message}`;
                if(data.message.image){
                    const img = document.createElement('img');
                    img.src = data.message.image;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.borderRadius = '8px';
                    msgDiv.appendChild(img);
                }
                chatMessages.appendChild(msgDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            } else {
                console.log(`New message from ${data.sender_name}`);
            }
        });
        let currentChatUserId = null;

        function openChat(profileImg, name, userId) {
            currentChatUserId = userId;
            document.getElementById('chatPatientName').innerText = name;
            document.getElementById('chatPatientImg').src = profileImg;
            document.getElementById('chatModal').classList.remove('d-none');

            const chatMessages = document.getElementById('chatMessages');
            chatMessages.innerHTML = '<p>Loading...</p>';

            fetch(`/doctor/chat/history/${userId}`)
                .then(res => res.json())
                .then(messages => {
                    chatMessages.innerHTML = '';
                    messages.forEach(msg => {
                        const msgDiv = document.createElement('div');
                        const isSender = msg.sender_id == {{ auth()->id() }};
                        msgDiv.className =
                            `chat-message ${isSender ? 'bg-primary text-white ms-auto' : 'bg-light'}`;
                        msgDiv.innerText = `${isSender ? 'You' : name}: ${msg.message}`;
                        chatMessages.appendChild(msgDiv);
                        if (msg.image) {
                            const img = document.createElement('img');
                            img.src = `{{ asset('uploads/messagesImgs/') }}/${msg.image}`;
                            img.style.width = '100%';
                            img.style.height = '100px';
                            img.style.objectFit='cover';
                            img.style.borderRadius = '8px';
                            msgDiv.appendChild(img);
                        }
                    });
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });
        }


        function closeChat() {
            currentChatUserId = null;
            document.getElementById('chatModal').classList.add('d-none');
        }

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            if (!message) return;

            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'chat-message bg-primary text-white ms-auto';
            messageDiv.innerText = `You: ${message}`;
            chatMessages.appendChild(messageDiv);
            input.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            if (!message || !currentChatUserId) return;
            axios.post('/send-message', {
                receiver_id: currentChatUserId,
                message: message
            });
        }

        function handleEnter(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }
    </script>
@endsection
