@extends(auth()->user()->role === 'translator' ? 'layouts.dashboard' : 'layouts.client-dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Project Chat: <span class="text-purple-600">{{ $project_name }}</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <div id="chat-container" class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                    <div class="bg-purple-700 p-4 text-white flex justify-between items-center">
                        <h2 class="text-xl font-semibold">Chat Room</h2>
                        <span id="online-status" class="text-sm">
                        <span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                        Online
                    </span>
                    </div>
                    <div id="messages" class="h-[calc(100vh-400px)] overflow-y-auto p-4 space-y-4 bg-gray-50">
                        <!-- Messages will be dynamically added here -->
                    </div>
                    <div class="border-t border-gray-200 p-4 bg-white">
                        <form id="chat-form" class="flex items-center space-x-3">
                            <input type="text" id="message-input" placeholder="Type your message..."
                                   class="flex-grow border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   maxlength="500" required>
                            <button type="submit"
                                    class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="send-button" disabled>
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <div>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                    <div class="bg-purple-700 p-4 text-white">
                        <h2 class="text-xl font-semibold">Project Files</h2>
                    </div>
                    <div class="p-4">
                        <form id="upload-form" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="file-input" name="file" class="hidden" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
                            <label for="file-input" class="cursor-pointer bg-white text-black px-4 py-2 rounded-lg border border-purple-500 hover:bg-purple-100 transition duration-200 inline-block mb-4">
                                <i class="fas fa-upload mr-2"></i> Choose Files
                            </label>
                            <button type="submit" id="upload-button" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition duration-200 ml-2 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                <i class="fas fa-cloud-upload-alt mr-2"></i> Upload
                            </button>
                        </form>

                        <div id="file-list" class="mt-4 grid grid-cols-2 gap-4">
                            <!-- File list items will be dynamically added here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="file-item-template">
        <div class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center justify-between">
            <div class="file-icon text-4xl mb-2"></div>
            <a href="#" target="_blank" class="file-name text-blue-600 hover:underline text-center mb-2 truncate w-full"></a>
            <button class="delete-btn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Delete
            </button>
        </div>
    </template>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        const pusher = new Pusher('{{ $pusherKey }}', {
            cluster: '{{ $pusherCluster }}'
        });

        const channel = pusher.subscribe('chat-channel');
        const messagesContainer = document.getElementById('messages');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');
        const chatForm = document.getElementById('chat-form');
        const uploadForm = document.getElementById('upload-form');
        const fileInput = document.getElementById('file-input');
        const uploadButton = document.getElementById('upload-button');

        // Listen for chat messages
        channel.bind('chat-event', function(data) {
            appendMessage(data);
        });

        // Listen for file upload events
        channel.bind('file-uploaded', function(data) {
            addFileToList(data.file);
        });

        // Enable/disable send button based on input
        messageInput.addEventListener('input', function() {
            sendButton.disabled = !this.value.trim();
        });

        // Handle chat form submission
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = messageInput.value.trim();

            if (message) {
                sendButton.disabled = true;
                fetch('{{ route('chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message, project_id: '{{ $projectId }}' })
                }).then(() => {
                    messageInput.value = '';
                    sendButton.disabled = true;
                }).catch(error => {
                    console.error('Error sending message:', error);
                    alert('Failed to send message. Please try again.');
                });
            }
        });

        // Function to append new messages to the chat
        function appendMessage(msg) {
            const isCurrentUser = msg.user_name === '{{ auth()->user()->name }}';
            msg.user_name = isCurrentUser ? 'You' : msg.user_name;

            const messageElement = document.createElement('div');
            messageElement.className = `flex ${isCurrentUser ? 'justify-end' : 'justify-start'} mb-4`;

            messageElement.innerHTML = `
            <div class="max-w-xs lg:max-w-md ${isCurrentUser ? 'bg-purple-200 text-black' : 'bg-gray-100 text-gray-800'} rounded-lg px-4 py-2 shadow">
                <p class="font-semibold text-sm mb-1">${msg.user_name}</p>
                <p class="text-sm">${escapeHtml(msg.message)}</p>
                ${msg.file ? `<a href="${msg.file.url}" target="_blank" class="text-blue-600 hover:underline text-sm">📎 ${escapeHtml(msg.file.filename)}</a>` : ''}
            </div>
        `;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Fetch existing messages
        fetch('{{ route('chat.fetch', ['projectId' => $projectId]) }}')
            .then(response => response.json())
            .then(messages => {
                messages.forEach(appendMessage);
            });

        // Enable/disable upload button based on file selection
        fileInput.addEventListener('change', function() {
            uploadButton.disabled = this.files.length === 0;
        });

        // Handle file upload
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData();
            const files = fileInput.files;

            if (files.length === 0) return;

            for (let i = 0; i < files.length; i++) {
                formData.append('file', files[i]);
            }

            uploadButton.disabled = true;
            fetch('{{ route('chat.upload', ['projectId' => $projectId]) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    addFileToList(data);
                    fileInput.value = '';
                    uploadButton.disabled = true;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to upload file. Please try again.');
                })
                .finally(() => {
                    uploadButton.disabled = false;
                });
        });

        // Function to add file to the list
        function addFileToList(file) {
            const template = document.getElementById('file-item-template');
            const fileElement = template.content.cloneNode(true);

            const container = fileElement.querySelector('div');
            container.dataset.fileId = file.id;

            const fileIcon = fileElement.querySelector('.file-icon');
            fileIcon.textContent = getFileIcon(file.filename);

            const fileLink = fileElement.querySelector('.file-name');
            fileLink.href = file.url;
            fileLink.textContent = file.filename;

            const deleteBtn = fileElement.querySelector('.delete-btn');
            if (file.user_id === {{ auth()->user()->id }}) {
                deleteBtn.addEventListener('click', () => deleteFile(file.id));
            } else {
                deleteBtn.remove();
            }

            document.getElementById('file-list').prepend(container);
        }

        // Function to delete a file
        function deleteFile(fileId) {
            if (confirm('Are you sure you want to delete this file? This action cannot be undone.')) {
                const fileElement = document.querySelector(`[data-file-id="${fileId}"]`);
                if (fileElement) {
                    fileElement.classList.add('opacity-50');
                }

                fetch(`/chat/files/${fileId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (fileElement) {
                            fileElement.remove();
                        }
                        console.log('File deleted successfully:', data.message);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        if (fileElement) {
                            fileElement.classList.remove('opacity-50');
                        }
                        alert('An error occurred while deleting the file.');
                    });
            }
        }

        // Function to get file icons based on the file extension
        function getFileIcon(filename) {
            const extension = filename.split('.').pop().toLowerCase();
            const iconMap = {
                pdf: '📄', doc: '📝', docx: '📝', xls: '📊', xlsx: '📊',
                ppt: '📽️', pptx: '📽️', jpg: '🖼️', jpeg: '🖼️', png: '🖼️',
                gif: '🖼️', txt: '📃', zip: '🗜️', rar: '🗜️',
            };
            return iconMap[extension] || '📎';
        }

        // Load existing files when the page loads
        fetch('{{ route('chat.files', ['projectId' => $projectId]) }}')
            .then(response => response.json())
            .then(files => {
                files.forEach(addFileToList);
            });

        // Helper function to escape HTML
        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>
\
@endsection
