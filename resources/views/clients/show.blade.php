<x-app-layout>
    <div class="bg-gray-100 min-h-screen pb-12">
        <!-- Hero Section -->
        <div class="h-64 bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 bg-cover bg-center relative">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <div class="absolute inset-0 flex items-center justify-center">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative -mt-32">
                <!-- Profile Header -->
                <div class="bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0">
                                    <img class="mx-auto h-32 w-32 rounded-full border-4 border-white shadow-lg object-cover"
                                         src="{{ $client->user->profile_photo_url }}"
                                         alt="{{ $client->user->name }}">
                                </div>
                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    <p class="text-3xl font-bold text-gray-900">{{ $client->user->name }}</p>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Client at Perfect Translate') }}</p>
                                    <div class="mt-2 flex flex-wrap">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200 mr-2 mb-2">
                                            {{ $client->industry }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-center sm:mt-0 space-x-4">
                                <a href="{{ route('clients.edit', $client) }}" class="flex justify-center items-center px-4 py-2 border border-purple-300 shadow-sm text-sm font-medium rounded-md text-purple-700 bg-white hover:bg-purple-50 transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    {{ __('Edit Profile') }}
                                </a>
                                <button onclick="openReviewsModal()" class="flex justify-center items-center px-4 py-2 border border-purple-300 shadow-sm text-sm font-medium rounded-md text-purple-700 bg-white hover:bg-purple-50 transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9m0 0V4m0 16l-7-7 7-7"></path></svg>
                                    {{ __('View Reviews') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-4 sm:divide-y-0 sm:divide-x">
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Company Name') }}</h3>
                            <span class="text-gray-700">{{ $client->company_name }}</span>
                        </div>
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Country') }}</h3>
                            <span class="text-gray-700">{{ $client->country }}</span>
                        </div>
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Average Rating') }}</h3>
                            @if($reviewCount > 0)
                                <div class="flex justify-center items-center">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($averageRating))
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-gray-600">{{ number_format($averageRating, 1) }}</span>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">{{ __('Based on :count reviews', ['count' => $reviewCount]) }}</p>
                            @else
                                <p class="text-gray-500">{{ __('No reviews yet') }}</p>
                            @endif
                        </div>
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Verification Status') }}</h3>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                {{ $client->verification_status === 'Not Verified' ? 'bg-red-100 text-red-800' :
                                   ($client->verification_status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                {{ $client->verification_status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <!-- Left Column -->
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 transition duration-300 ease-in-out hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Contact Information') }}</h3>
                            <dl class="mt-2 text-sm text-gray-600 space-y-4">
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-24">
                                        <svg class="h-5 w-5 text-gray-400 mr-2 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        {{ __('Email') }}:
                                    </dt>
                                    <dd class="ml-2">{{ $client->user->email }}</dd>
                                </div>
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-24">
                                        <svg class="h-5 w-5 text-gray-400 mr-2 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        {{ __('Phone') }}:
                                    </dt>
                                    <dd class="ml-2">{{ $client->contact_phone }}</dd>
                                </div>
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-24">
                                        <svg class="h-5 w-5 text-gray-400 mr-2 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Website') }}:
                                    </dt>
                                    <dd class="ml-2">{{ $client->website }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 transition duration-300 ease-in-out hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Company Address') }}</h3>
                            <p class="text-sm text-gray-600">{{ $client->company_address }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 transition duration-300 ease-in-out hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('About') }}</h3>
                            <div class="prose max-w-none text-gray-600">
                                {{ $client->bio }}
                            </div>
                        </div>

                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 transition duration-300 ease-in-out hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Company Details') }}</h3>
                            <dl class="mt-2 text-sm text-gray-600 space-y-4">
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-40">{{ __('Contact Name') }}:</dt>
                                    <dd class="ml-2">{{ $client->contact_name }}</dd>
                                </div>
                                <div class="flex items-center">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-40">{{ __('Industry') }}:</dt>
                                    <dd class="ml-2">{{ $client->industry }}</dd>
                                </div>
                            </dl>
                        </div>

                        @if($client->verification_status === 'Not Verified')
                            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 transition duration-300 ease-in-out hover:shadow-xl">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Upload Business Registration') }}</h3>
                                <form id="uploadForm" action="{{ route('clients.upload-document') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                                    <span>{{ __('Upload a file') }}</span>
                                                    <input id="file-upload" name="documents[]" type="file" class="sr-only" multiple accept=".pdf">
                                                </label>
                                                <p class="pl-1">{{ __('or drag and drop') }}</p>
                                            </div>
                                            <p class="text-xs text-gray-500">{{ __('PDF up to 10MB') }}</p>
                                        </div>
                                    </div>
                                    <div id="file-list" class="mt-4 space-y-2"></div>
                                    <div id="file-error" class="hidden mt-2 text-sm text-red-600"></div>
                                    <div class="mt-5 flex justify-between">
                                        <button type="submit" id="uploadButton" class="flex-grow mr-2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out">
                                            {{ __('Upload Documents') }}
                                        </button>
                                        <button type="button" id="cancelButton" class="flex-grow ml-2 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out">
                                            {{ __('Cancel') }}
                                        </button>
                                    </div>
                                </form>
                            </div>


        @elseif($client->verification_status === 'Pending')
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            {{ __('Your documents are being reviewed. You will be notified once the verification is complete.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Modal -->
    <div id="reviewsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="inline-block h-screen align-middle" aria-hidden="true">&#8203;</span>

            <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all align-middle max-w-3xl w-full p-6 my-8">
                <div class="flex justify-between items-center border-b pb-4">
                    <h3 class="text-2xl font-semibold text-gray-900">{{ __('Reviews') }}</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500 transition duration-150 ease-in-out" onclick="closeReviewsModal()">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="mt-6">
                    @if($reviews->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($reviews as $review)
                                <li class="py-6">
                                    <div class="flex items-center">
                                        <img class="h-12 w-12 rounded-full object-cover" src="{{ $review->reviewer->profile_photo_url }}" alt="{{ $review->reviewer->name }}">
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">{{ $review->reviewer->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-gray-700">{{ $review->review }}</p>
                                        <div class="mt-2 flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.88 8.719c-.784-.57-.381-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                                    </svg>
                                                @else
                                                    <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.88 8.719c-.784-.57-.381-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">{{ __('No reviews yet.') }}</p>
                    @endif

                    <div class="mt-6">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateFileInput() {
            const fileInput = document.getElementById('file-upload');
            const errorDiv = document.getElementById('file-error');

            if (fileInput.files.length === 0) {
                errorDiv.textContent = 'Please select at least one file to upload.';
                errorDiv.classList.remove('hidden');
                return false;
            }

            errorDiv.classList.add('hidden');
            return true;
        }

        function openReviewsModal() {
            document.getElementById('reviewsModal').classList.remove('hidden');
        }

        function closeReviewsModal() {
            document.getElementById('reviewsModal').classList.add('hidden');
        }

        const fileInput = document.getElementById('file-upload');
        const fileList = document.getElementById('file-list');
        const errorDiv = document.getElementById('file-error');
        const uploadForm = document.getElementById('uploadForm');
        const uploadButton = document.getElementById('uploadButton');
        const cancelButton = document.getElementById('cancelButton');

        fileInput.addEventListener('change', updateFileList);

        function updateFileList() {
            fileList.innerHTML = '';
            errorDiv.classList.add('hidden');

            Array.from(fileInput.files).forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex justify-between items-center';
                fileItem.innerHTML = `
                    <span class="text-sm text-gray-600">${file.name}</span>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeFile(${index})">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                `;
                fileList.appendChild(fileItem);
            });
        }

        function removeFile(index) {
            const dt = new DataTransfer();
            const { files } = fileInput;

            for (let i = 0; i < files.length; i++) {
                if (index !== i) dt.items.add(files[i]);
            }

            fileInput.files = dt.files;
            updateFileList();
        }

        function validateFiles() {
            const files = fileInput.files;
            if (files.length === 0) {
                showError('Please select at least one file to upload.');
                return false;
            }

            const maxSize = 10 * 1024 * 1024; // 10MB
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    showError(`File "${files[i].name}" exceeds the 10MB limit.`);
                    return false;
                }
                if (!files[i].name.toLowerCase().endsWith('.pdf')) {
                    showError(`File "${files[i].name}" is not a PDF.`);
                    return false;
                }
            }

            return true;
        }

        function showError(message) {
            errorDiv.textContent = message;
            errorDiv.classList.remove('hidden');
        }

        uploadForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (validateFiles()) {
                uploadForm.submit();
            }
        });

        cancelButton.addEventListener('click', () => {
            fileInput.value = '';
            fileList.innerHTML = '';
            errorDiv.classList.add('hidden');
        });
    </script>
</x-app-layout>
