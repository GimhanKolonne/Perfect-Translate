<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">

                    <div class="bg-white rounded-lg p-6">
                        <x-form-section submit="updateProfileInformation">
                            <x-slot name="title">
                                <span class="text-2xl text-gray-800">{{ __('Client Information') }}</span>
                            </x-slot>

                            <x-slot name="description">
                                <!-- Description can go here if needed -->
                            </x-slot>

                            <x-slot name="form">
                                <!-- Profile Photo -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="photo" value="{{ __('Profile Photo') }}" class="text-lg text-gray-700" />
                                    <div class="mt-2 flex justify-center">
                                        <img src="{{ $client->user->profile_photo_url }}" alt="{{ $client->user->name }}" class="rounded-full h-32 w-32 object-cover border-4 border-white">
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4 mt-6">
                                    <x-label for="name" value="{{ __('Name') }}" class="text-gray-700" />
                                    <x-input id="name" type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->user->name }}" disabled />
                                </div>

                                <!-- Email -->
                                <div class="col-span-6 sm:col-span-4 mt-4">
                                    <x-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                                    <x-input id="email" type="email" class="mt-1 block w-full bg-gray-50" value="{{ $client->user->email }}" disabled />
                                </div>

                                <!-- Company Details Section -->
                                <div class="col-span-6 sm:col-span-4 mt-6">
                                    <h3 class="text-lg font-medium text-gray-700 mb-4">{{ __('Company Details') }}</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <x-label value="{{ __('Company Name') }}" class="text-gray-700" />
                                            <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->company_name }}" disabled />
                                        </div>
                                        <div>
                                            <x-label value="{{ __('Contact Name') }}" class="text-gray-700" />
                                            <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->contact_name }}" disabled />
                                        </div>
                                        <div>
                                            <x-label value="{{ __('Contact Phone') }}" class="text-gray-700" />
                                            <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->contact_phone }}" disabled />
                                        </div>
                                        <div>
                                            <x-label value="{{ __('Company Address') }}" class="text-gray-700" />
                                            <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->company_address }}" disabled />
                                        </div>
                                        <div>
                                            <x-label value="{{ __('Country') }}" class="text-gray-700" />
                                            <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->country }}" disabled />
                                        </div>
                                        <div>
                                            <x-label value="{{ __('Website') }}" class="text-gray-700" />
                                            <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->website }}" disabled />
                                        </div>
                                        <div>
                                            <x-label value="{{ __('Industry') }}" class="text-gray-700" />
                                            <x-input type="text" class="mt-1 block w-full bg-gray-50" value="{{ $client->industry }}" disabled />
                                        </div>
                                    </div>
                                </div>

                                <!-- About You Section -->
                                <div class="col-span-6 sm:col-span-4 mt-6">
                                    <x-label value="{{ __('Bio') }}" class="text-lg text-gray-700 mb-2" />
                                    <textarea class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md bg-gray-50" rows="4" disabled>{{ $client->bio }}</textarea>
                                </div>
                            </x-slot>
                        </x-form-section>

                        <!-- Edit Button -->
                        <div class="mt-8 flex justify-center">
                            <a href="{{ route('clients.edit', $client) }}" class="px-6 py-3 bg-gradient-to-r from-purple-400 to-purple-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
