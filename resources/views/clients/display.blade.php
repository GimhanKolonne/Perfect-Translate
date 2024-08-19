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
                                    <div class="mt-2">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200">
                                            {{ $client->industry }}
                                        </span>
                                    </div>
                                </div>
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
                        @if(auth()->user()->role === 'translator' || auth()->user()->role === 'client')
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
                                        <dd class="ml-2">
                                            <a href="{{ $client->website }}" class="text-blue-600 hover:text-blue-800 hover:underline" target="_blank" rel="noopener noreferrer">
                                                {{ $client->website }}
                                            </a>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        @endif

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

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
