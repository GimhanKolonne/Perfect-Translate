@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <h1 class="text-4xl font-bold text-gray-800 text-center mb-8">
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-500">
            Project Chat: {{ $project_name }}
        </span>
        </h1>

        <div id="chat-container" class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-200">
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-4 text-white flex justify-between items-center">
                <h2 class="text-xl font-semibold">Chat Room</h2>
                <div class="flex space-x-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
            </div>
            <div id="messages" class="h-[36rem] overflow-y-auto p-6 space-y-4 bg-gray-50 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
            </div>
            <div class="border-t border-gray-200 p-4 bg-white">
                <form id="chat-form" class="flex items-center space-x-3">
                    <input type="text" id="message-input" placeholder="Type your message..."
                           class="flex-grow border-2 border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-gray-50">
                    <button type="submit" id="send-button"
                            class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-8 py-3 rounded-full hover:from-blue-600 hover:to-purple-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 shadow-md hover:shadow-lg transform hover:scale-105">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script>
        const pusher = new Pusher('{{ $pusherKey }}', {
            cluster: '{{ $pusherCluster }}'
        });

        const channel = pusher.subscribe('chat-channel');
        const messagesContainer = document.getElementById('messages');

        channel.bind('chat-event', function(data) {
            appendMessage(data);
        });

        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();

            if (message) {
                fetch('/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message, project_id: '{{ $projectId }}' })
                });

                messageInput.value = '';
            }
        });

        function appendMessage(msg) {
            msg.user_name === '{{auth()->user()->name}}' ? msg.user_name = 'You' : msg.user_name;
            const isCurrentUser = msg.user_name === 'You';

            const messageElement = document.createElement('div');
            messageElement.className = `flex items-start ${isCurrentUser ? 'justify-end' : 'justify-start'} mb-4 opacity-0`;

            messageElement.innerHTML = `
            <div class="max-w-xs lg:max-w-md ${isCurrentUser ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'bg-white text-gray-800'} rounded-2xl px-5 py-3 shadow-md">
                <p class="font-semibold mb-1">${msg.user_name}</p>
                <p class="text-sm">${msg.message}</p>
            </div>
        `;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

            // Animate the new message
            anime({
                targets: messageElement,
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 500,
                easing: 'easeOutCubic'
            });
        }

        fetch('/fetch-messages/{{ $projectId }}')
            .then(response => response.json())
            .then(messages => {
                messages.forEach(appendMessage);
            });

    </script>
@endsection
