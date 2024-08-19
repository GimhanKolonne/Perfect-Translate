<x-app-layout>
    <div class="bg-gray-100 min-h-screen pb-12">
        <div class="h-48 bg-gradient-to-r from-purple-400 via-purple-500 to-purple-600 bg-cover bg-center"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative -mt-24">
                <!-- Profile Header -->
                <div class="bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0">
                                    <img class="mx-auto h-32 w-32 rounded-full border-4 border-white shadow-lg"
                                         src="{{ $translator->user->profile_photo_url }}"
                                         alt="{{ $translator->user->name }}">
                                </div>
                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    <p class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ $translator->user->name }}</p>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Translator at Perfect Translate') }}</p>
                                    <div class="mt-2">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $translator->verification_status === 'Not Verified' ? 'bg-red-100 text-red-800' :
                                               ($translator->verification_status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                            {{ $translator->verification_status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Expertise') }}</h3>
                            <div class="flex flex-wrap justify-center">
                                @foreach(json_decode($translator->type_of_translator) as $type)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
                                        {{ $type }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="px-6 py-5 text-sm font-medium text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Language Skills') }}</h3>
                            <div class="flex flex-wrap justify-center">
                                @foreach(json_decode($translator->language_pairs) as $pair)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2 mb-2">
                                        {{ $pair }}
                                    </span>
                                @endforeach
                            </div>
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
                                <dl class="mt-2 text-sm text-gray-600">
                                    <div class="mt-3 flex">
                                        <dt class="flex-shrink-0 font-medium text-gray-700 w-24">{{ __('Email') }}:</dt>
                                        <dd class="ml-2">{{ $translator->user->email }}</dd>
                                    </div>
                                </dl>
                            </div>
                        @endif

                        <!-- Professional Details Section -->
                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Professional Details') }}</h3>
                            <div class="grid grid-cols-1 gap-4">
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
                    </div>

                    <!-- Right Column -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('About') }}</h3>
                            <div class="prose max-w-none text-gray-600">
                                {{ $translator->bio }}
                            </div>
                        </div>

                        @if(auth()->user()->role === 'translator' || auth()->user()->role === 'client')
                            <!-- Past Jobs Section -->
                            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Past Jobs') }}</h3>
                                @if($translator->portfolios->isEmpty())
                                    <p class="text-gray-600">{{ __('No past jobs available.') }}</p>
                                @else
                                    <ul class="space-y-4">
                                        @foreach($translator->portfolios as $portfolio)
                                            <li class="border-b border-gray-200 pb-4 last:border-b-0">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <p class="text-lg font-semibold text-gray-800">{{ $portfolio->title }}</p>
                                                        <p class="text-sm text-gray-600">{{ $portfolio->role_description }}</p>
                                                    </div>
                                                    <div class="flex space-x-4 items-center">
                                                        <button type="button" class="text-blue-600 hover:text-blue-800 hover:underline" onclick="openModal('{{ $portfolio->id }}')">
                                                            {{ __('View Details') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
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
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">${data.title}</h2>
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-2">{{ __('Role Description') }}</h3>
                                    <p class="text-gray-600">${data.role_description}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-2">{{ __('Overview') }}</h3>
                                    <p class="text-gray-600">${data.overview}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-gray-800 mb-2">{{ __('Relevant Skills') }}</h4>
                                    <p class="text-gray-600">${data.relevant_skills}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-gray-800 mb-2">{{ __('Tags') }}</h4>
                                    <p class="text-gray-600">${data.tags}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-gray-800 mb-2">{{ __('Media') }}</h4>
                                    <div class="space-y-2">
                                        ${data.media.map(media => `<a href="/storage/${media}" class="text-blue-600 hover:text-blue-800 hover:underline block" target="_blank" download>${media}</a>`).join('')}
                                    </div>
                                </div>
                            </div>
                        `;
                        modal.classList.remove('hidden');
                    });
            }

            function closeModal() {
                document.getElementById('portfolio-modal').classList.add('hidden');
            }
        </script>
    </div>
</x-app-layout>
