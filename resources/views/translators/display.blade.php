<x-app-layout>
    <div class="bg-gradient-to-br from-purple-100 to-indigo-100 min-h-screen pb-12">
        <div class="h-64 bg-purple-700"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative -mt-32">
                <!-- Profile Header -->
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    <div class="p-6 sm:p-8 md:p-10 bg-gradient-to-br from-purple-50 to-indigo-50">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-8 items-center">
                                <div class="flex-shrink-0 relative">
                                    <img class="h-40 w-40 rounded-full border-4 border-white shadow-lg"
                                         src="{{ $translator->user->profile_photo_url }}"
                                         alt="{{ $translator->user->name }}">
                                    <div class="absolute bottom-0 right-0 bg-white rounded-full p-1">
                                        <span class="w-6 h-6 rounded-full {{ $translator->verification_status === 'Not Verified' ? 'bg-red-500' : ($translator->verification_status === 'Pending' ? 'bg-yellow-500' : 'bg-green-500') }} flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 sm:text-left">
                                    <h1 class="text-3xl font-bold text-gray-900">{{ $translator->user->name }}</h1>
                                    <p class="text-lg font-medium text-purple-600 mt-1">{{ __('Translator at Perfect Translate') }}</p>
                                    <div class="mt-3 flex items-center">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                            {{ $translator->verification_status === 'Not Verified' ? 'bg-red-100 text-red-800' :
                                               ($translator->verification_status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                            {{ $translator->verification_status }}
                                        </span>
                                        <span class="ml-3 text-sm text-gray-500">{{ __('Member since') }} {{ $translator->user->created_at->format('M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 sm:mt-0 flex flex-col items-center sm:items-end">
                                <div class="flex items-center">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($averageRating))
                                                <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg class="h-6 w-6 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-xl font-semibold text-gray-800">{{ number_format($averageRating, 1) }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">{{ __('Based on :count reviews', ['count' => $reviewCount]) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-purple-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                        <div class="px-6 py-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Expertise') }}</h3>
                            <div class="flex flex-wrap">
                                @foreach(json_decode($translator->type_of_translator) as $type)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 mr-2 mb-2">
                                        {{ $type }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="px-6 py-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Language Skills') }}</h3>
                            <div class="flex flex-wrap">
                                @foreach(json_decode($translator->language_pairs) as $pair)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 mr-2 mb-2">
                                        {{ $pair }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="px-6 py-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Quick Stats') }}</h3>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Jobs Completed') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $translator->jobs_completed }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">{{ __('On-Time Delivery') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $translator->on_time_delivery_rate }}%</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Response Rate') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $translator->response_rate }}%</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Repeat Clients') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $translator->repeat_client_rate }}%</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Left Column -->
                    <div class="lg:col-span-1 space-y-8">
                        @if(auth()->user()->role === 'translator' || auth()->user()->role === 'client')
                            <div class="bg-white shadow-lg rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Contact Information') }}</h3>
                                <dl class="text-sm text-gray-600">
                                    <div class="flex mt-3">
                                        <dt class="font-medium text-gray-700 w-24">{{ __('Email') }}:</dt>
                                        <dd class="ml-2">{{ $translator->user->email }}</dd>
                                    </div>
                                </dl>
                            </div>
                        @endif

                        <!-- Professional Details Section -->
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Professional Details') }}</h3>
                            <div class="space-y-4">
                                <div>
                                    <x-label for="years_of_experience" value="{{ __('Years of Experience') }}" class="text-gray-700" />
                                    <x-input id="years_of_experience" type="text" class="mt-1 block w-full bg-purple-50" value="{{ $translator->years_of_experience }}" disabled />
                                </div>
                                <div>
                                    <x-label for="rate_per_word" value="{{ __('Rate per Word') }}" class="text-gray-700" />
                                    <x-input id="rate_per_word" type="text" class="mt-1 block w-full bg-purple-50" value="{{ number_format($translator->rate_per_word, 2) }}" disabled />
                                </div>
                                <div>
                                    <x-label for="rate_per_hour" value="{{ __('Rate per Hour') }}" class="text-gray-700" />
                                    <x-input id="rate_per_hour" type="text" class="mt-1 block w-full bg-purple-50" value="{{ number_format($translator->rate_per_hour, 2) }}" disabled />
                                </div>
                                <div>
                                    <x-label for="availability" value="{{ __('Availability') }}" class="text-gray-700" />
                                    <x-input id="availability" type="text" class="mt-1 block w-full bg-purple-50" value="{{ $translator->availability }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Right Column -->
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('About') }}</h3>
                            <div class="prose max-w-none text-gray-600">
                                {{ $translator->bio }}
                            </div>
                        </div>

                        @if(auth()->user()->role === 'translator' || auth()->user()->role === 'client')
                            <!-- Past Jobs Section -->
                            <div class="bg-white shadow-lg rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Past Jobs') }}</h3>
                                @if($translator->portfolios->isEmpty())
                                    <p class="text-gray-600">{{ __('No past jobs available.') }}</p>
                                @else
                                    <ul class="divide-y divide-gray-200">
                                        @foreach($translator->portfolios as $portfolio)
                                            <li class="py-4">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="text-lg font-semibold text-gray-800">{{ $portfolio->title }}</p>
                                                        <p class="text-sm text-gray-600">{{ $portfolio->role_description }}</p>
                                                    </div>
                                                    <button type="button" class="text-purple-600 hover:text-purple-800 font-medium" onclick="openModal('{{ $portfolio->id }}')">
                                                        {{ __('View Details') }}
                                                    </button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif

                        <!-- Reviews Section -->
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Reviews') }}</h3>
                            @if($reviews->count() > 0)
                                <ul class="divide-y divide-gray-200">
                                    @foreach($reviews as $review)
                                        <li class="py-6">
                                            <div class="flex items-center">
                                                <img class="h-12 w-12 rounded-full" src="{{ $review->reviewer->profile_photo_url }}" alt="{{ $review->reviewer->name }}">
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
                                                    <span class="ml-2 text-sm text-gray-600">{{ $review->rating }}/5</span>
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
        </div>

        <!-- Modal -->
        <div id="portfolio-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-4xl relative">
                    <button type="button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" onclick="closeModal()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div id="modal-content" class="mt-4"></div>
                </div>
            </div>
        </div>

        <script>
            function openModal(portfolioId) {
                const modal = document.getElementById('portfolio-modal');
                const modalContent = document.getElementById('modal-content');

                fetch(`/portfolios/${portfolioId}`)
                    .then(response => response.json())
                    .then(data => {
                        modalContent.innerHTML = `
                            <div class="bg-white rounded-lg shadow-xl overflow-hidden max-w-4xl w-full">
                                <div class="px-6 py-4 bg-gradient-to-r from-purple-600 via-purple-500 to-indigo-500">
                                    <h2 class="text-3xl font-bold text-white">${data.title}</h2>
                                </div>
                                <div class="p-6 space-y-6">
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Role Description') }}</h3>
                                        <p class="text-gray-700">${data.role_description}</p>
                                    </div>
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Overview') }}</h3>
                                        <p class="text-gray-700">${data.overview}</p>
                                    </div>
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Relevant Skills') }}</h4>
                                        <p class="text-gray-700">${data.relevant_skills}</p>
                                    </div>
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Tags') }}</h4>
                                        <div class="flex flex-wrap gap-2">
                                            ${data.tags.split(',').map(tag => `<span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">${tag.trim()}</span>`).join('')}
                                        </div>
                                    </div>
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Media') }}</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            ${data.media.map(media => `
                                                <a href="/storage/${media}" class="flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-150 ease-in-out" target="_blank" download>
                                                    <svg class="w-6 h-6 text-purple-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V8"></path></svg>
                                                    <span class="text-sm font-medium text-gray-700 truncate">${media}</span>
                                                </a>
                                            `).join('')}
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-4 bg-purple-50 text-right">
                                    <button onclick="closeModal()" class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-150 ease-in-out">Close</button>
                                </div>
                            </div>
                        `;
                        modal.classList.remove('hidden');
                    });
            }

            function closeModal() {
                const modal = document.getElementById('portfolio-modal');
                modal.classList.add('hidden');
            }
        </script>
    </div>
</x-app-layout>
