<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <h1 class="text-3xl font-bold text-white text-center">Translator Profile</h1>
            </div>

            <!-- Profile Photo and Name Section -->

            <div class="bg-white p-6 flex items-center justify-center flex-col">
                <div class="w-20 h-20 rounded-full overflow-hidden">
                    <img src="{{ $translator->user->profile_photo_url }}" alt="{{ $translator->user->name }}" class="w-full h-full object-cover">
                </div>
                <h2 class="mt-4 text-2xl font-semibold text-gray-800">{{ $translator->user->name }}</h2>
            </div>

            <div class="p-6 sm:p-8">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Expertise Section -->
                    <div>
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Expertise</h2>
                            <label class="block text-sm font-medium text-gray-700 mb-2 pb-4">Types of Translation:</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(json_decode($translator->type_of_translator) as $type)
                                    <div class="flex items-center">
                                        <span class="inline-block bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">{{ $type }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Language Skills</h2>
                            <label class="block text-sm font-medium text-gray-700 mb-2 pb-4">Language Pairs:</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(json_decode($translator->language_pairs) as $pair)
                                    <div class="flex items-center">
                                        <span class="inline-block bg-green-100 text-green-800 rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">{{ $pair }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Professional Details Section -->
                    <div>
                        <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Professional Details</h2>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Years of Experience</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $translator->years_of_experience }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rate per Word</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ number_format($translator->rate_per_word, 2) }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rate per Hour</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ number_format($translator->rate_per_hour, 2) }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Availability</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $translator->availability }}</p>
                        </div>
                    </div>
                </div>

                <!-- About You Section -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">About You</h2>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $translator->bio }}</p>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('translators.edit', $translator) }}" class="px-4 py-2 bg-blue-500 text-black font-medium rounded-md border-2 border-blue-700 shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
