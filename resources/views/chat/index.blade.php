@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">Project Chat: {{ $project_name }}</h1>

        <div id="chat-container" class="max-w-3xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
            <div id="messages" class="h-96 overflow-y-auto p-6 space-y-4">
                @foreach ($messages as $msg)
                    <div class="flex items-start {{ $msg->user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs lg:max-w-md {{ $msg->user_id == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800' }} rounded-lg px-4 py-2 shadow">
                            <img src="{{auth()->user()->profile_photo_url}}" alt="User Avatar" class="w-6 h-6 rounded-full">
                            <p class="font-semibold">{{ $msg->user_name }}</p>
                            <p>{{ $msg->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-gray-200 p-4">
                <form id="chat-form" class="flex items-center space-x-3">
                    <input type="text" id="message-input" placeholder="Type your message..." class="flex-grow border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" id="send-button" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
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
            const isCurrentUser = msg.user_id === '{{ auth()->id() }}';
            const messageElement = document.createElement('div');
            messageElement.className = `flex items-start ${isCurrentUser ? 'justify-end' : 'justify-start'}`;
            messageElement.innerHTML = `
            <div class="max-w-xs lg:max-w-md ${isCurrentUser ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800'} rounded-lg px-4 py-2 shadow">
                <p class="font-semibold">${msg.user_name}</p>
                <p>${msg.message}</p>
            </div>
        `;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        fetch('/fetch-messages/{{ $projectId }}')
            .then(response => response.json())
            .then(messages => {
                messages.forEach(appendMessage);
            });
    </script>
@endsection
