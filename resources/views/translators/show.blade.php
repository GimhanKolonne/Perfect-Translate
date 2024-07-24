<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="bg-white rounded-lg p-6">
                    <x-form-section submit="updateProfileInformation">
                        <x-slot name="title">
                            <span class="text-2xl text-gray-800">{{ __('Translator Information') }}</span>
                        </x-slot>

                        <x-slot name="description">
                            <!-- Description can go here if needed -->
                        </x-slot>

                        <x-slot name="form">
                            <!-- Profile Photo -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="photo" value="{{ __('Profile Photo') }}" class="text-lg text-gray-700" />
                                <div class="mt-2 flex justify-center">
                                    <img src="{{ $translator->user->profile_photo_url }}" alt="{{ $translator->user->name }}" class="rounded-full h-32 w-32 object-cover border-4 border-white">
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4 mt-6">
                                <x-label for="name" value="{{ __('Name') }}" class="text-gray-700" />
                                <x-input id="name" type="text" class="mt-1 block w-full bg-gray-50" value="{{ $translator->user->name }}" disabled />
                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                                <x-input id="email" type="email" class="mt-1 block w-full bg-gray-50" value="{{ $translator->user->email }}" disabled />
                            </div>

                            <!-- Verification Status -->
                            <div class="col-span-6 sm:col-span-4 mt-6">
                                <x-label value="{{ __('Verification Status') }}" class="text-lg text-gray-700 mb-2" />
                                <div class="mt-2 bg-gray-50 p-3 rounded-md">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $translator->verification_status === 'Not Verified' ? 'bg-red-100 text-red-800' :
                                           ($translator->verification_status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        {{ $translator->verification_status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Expertise Section -->
                            <div class="col-span-6 sm:col-span-4 mt-6">
                                <x-label value="{{ __('Types of Translation') }}" class="text-lg text-gray-700 mb-2" />
                                <div class="mt-2 flex flex-wrap bg-gray-50 p-3 rounded-md">
                                    @foreach(json_decode($translator->type_of_translator) as $type)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
                                            {{ $type }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Language Skills Section -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-label value="{{ __('Language Pairs') }}" class="text-lg text-gray-700 mb-2" />
                                <div class="mt-2 flex flex-wrap bg-gray-50 p-3 rounded-md">
                                    @foreach(json_decode($translator->language_pairs) as $pair)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2 mb-2">
                                            {{ $pair }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Professional Details Section -->
                            <div class="col-span-6 sm:col-span-4 mt-6">
                                <h3 class="text-lg font-medium text-gray-700 mb-4">{{ __('Professional Details') }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-label value="{{ __('Years of Experience') }}" class="text-gray-700" />
                                        <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $translator->years_of_experience }}" disabled />
                                    </div>
                                    <div>
                                        <x-label value="{{ __('Rate per Word') }}" class="text-gray-700" />
                                        <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ number_format($translator->rate_per_word, 2) }}" disabled />
                                    </div>
                                    <div>
                                        <x-label value="{{ __('Rate per Hour') }}" class="text-gray-700" />
                                        <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ number_format($translator->rate_per_hour, 2) }}" disabled />
                                    </div>
                                    <div>
                                        <x-label value="{{ __('Availability') }}" class="text-gray-700" />
                                        <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $translator->availability }}" disabled />
                                    </div>
                                </div>
                            </div>

                            <!-- About You Section -->
                            <div class="col-span-6 sm:col-span-4 mt-6">
                                <x-label value="{{ __('Bio') }}" class="text-lg text-gray-700 mb-2" />
                                <textarea class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md bg-gray-50" rows="4" disabled>{{ $translator->bio }}</textarea>
                            </div>
                        </x-slot>
                    </x-form-section>

                    <!-- Messages and Actions Section -->
                    <div class="mt-8">
                        @if ($errors->any())
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <p class="font-bold">There were some problems with your input.</p>
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                                <p class="font-bold">Success!</p>
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <p class="font-bold">Error!</p>
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif

                        <div class="flex justify-between items-center">
                            <a href="{{ route('translators.edit', $translator) }}" class="px-6 py-3 bg-gradient-to-r from-purple-400 to-purple-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                                Edit Profile
                            </a>

                            @if($translator->verification_status === 'Not Verified')
                                <form action="{{ route('translators.upload-certificate') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-4">
                                    @csrf
                                    <input type="file" name="certificate" accept=".pdf" class="border p-2 rounded">
                                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-400 to-purple-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                                        Upload Certificate
                                    </button>
                                </form>
                            @elseif($translator->verification_status === 'Pending')
                                <p class="text-yellow-600 font-medium">Your certificate is under review.</p>
                            @else
                                <p class="text-green-600 font-medium">Your profile is verified.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
