<x-app-layout>
    <div class="bg-gray-100 min-h-screen pb-12">
        <!-- Hero Section -->
        <div class="h-48 bg-gradient-to-r from-purple-400 via-purple-500 to-purple-600 bg-cover bg-center"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative -mt-24">
                <!-- Profile Header -->
                <div class="bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 sm:py-6">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0">
                                    <img class="mx-auto h-32 w-32 rounded-full border-4 border-white shadow-lg"
                                         src="{{ $client->user->profile_photo_url }}"
                                         alt="{{ $client->user->name }}">
                                </div>
                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    <p class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ $client->user->name }}</p>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Client at Perfect Translate') }}</p>
                                    <div class="mt-2 flex flex-wrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200 mr-2 mb-2">
                                            {{ $client->industry }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-center sm:mt-0">
                                <a href="{{ route('clients.edit', $client) }}" class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    {{ __('Edit Profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Company Name') }}</h3>
                            <span class="text-gray-700">{{ $client->company_name }}</span>
                        </div>
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Country') }}</h3>
                            <span class="text-gray-700">{{ $client->country }}</span>
                        </div>
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Verification Status') }}</h3>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $client->verification_status === 'Not Verified' ? 'bg-red-100 text-red-800' :
                                   ($client->verification_status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                {{ $client->verification_status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <!-- Left Column -->
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Contact Information') }}</h3>
                            <dl class="mt-2 text-sm text-gray-600 space-y-3">
                                <div class="flex">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-24">{{ __('Email') }}:</dt>
                                    <dd class="ml-2">{{ $client->user->email }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-24">{{ __('Phone') }}:</dt>
                                    <dd class="ml-2">{{ $client->contact_phone }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-24">{{ __('Website') }}:</dt>
                                    <dd class="ml-2">{{ $client->website }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Company Address') }}</h3>
                            <p class="text-sm text-gray-600">{{ $client->company_address }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('About') }}</h3>
                            <div class="prose max-w-none text-gray-600">
                                {{ $client->bio }}
                            </div>
                        </div>

                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Company Details') }}</h3>
                            <dl class="mt-2 text-sm text-gray-600 space-y-3">
                                <div class="flex">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-40">{{ __('Contact Name') }}:</dt>
                                    <dd class="ml-2">{{ $client->contact_name }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="flex-shrink-0 font-medium text-gray-700 w-40">{{ __('Industry') }}:</dt>
                                    <dd class="ml-2">{{ $client->industry }}</dd>
                                </div>
                            </dl>
                        </div>

                        @if($client->verification_status === 'Not Verified')
                            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Upload Business Registration') }}</h3>
                                <form action="{{ route('clients.upload-document') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFileInput()">
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
                                    <div id="file-error" class="hidden mt-2 text-sm text-red-600"></div>
                                    <div class="mt-5">
                                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            {{ __('Upload Documents') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @elseif($client->verification_status === 'Pending')
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
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
    </script>
</x-app-layout>
