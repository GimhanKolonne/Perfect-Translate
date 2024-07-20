<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <h1 class="text-3xl font-bold text-white text-center">Create Your Translator Profile</h1>
            </div>

            <form action="{{ route('translators.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <!-- Other form fields go here -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Expertise Section -->
                    <div>
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Expertise</h2>
                            <label class="block text-sm font-medium text-gray-700 mb-2 pb-4">What Type of Translator are you?</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(['General', 'Technical', 'Legal', 'Medical', 'Literary', 'Financial'] as $type)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="type_of_translator[]" id="type_{{ $type }}" value="{{ $type }}" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="type_{{ $type }}" class="ml-2 text-sm text-gray-700">{{ $type }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Language Skills</h2>
                            <label class="block text-sm font-medium text-gray-700 mb-2 pb-4">Language Pairs</label>
                            <div class="grid grid-cols-2 gap-2">
                                @php
                                    $languages = ['Sinhala', 'Tamil', 'English'];
                                    $pairs = [];
                                    foreach ($languages as $from) {
                                        foreach ($languages as $to) {
                                            if ($from !== $to) {
                                                $pairs[] = "$from to $to";
                                            }
                                        }
                                    }
                                @endphp
                                @foreach($pairs as $pair)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="language_pairs[]" id="pair_{{ str_replace(' ', '_', $pair) }}" value="{{ $pair }}" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="pair_{{ str_replace(' ', '_', $pair) }}" class="ml-2 text-sm text-gray-700">{{ $pair }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Professional Details Section -->
                    <div>
                        <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Professional Details</h2>

                        <div class="mb-4">
                            <label for="years_of_experience" class="block text-sm font-medium text-gray-700 mb-1 pb-4">Years of Experience</label>
                            <input type="number" name="years_of_experience" id="years_of_experience" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" min="0">
                        </div>

                        <div class="mb-4">
                            <label for="rate_per_word" class="block text-sm font-medium text-gray-700 mb-1">Rate per Word ($)</label>
                            <input type="number" name="rate_per_word" id="rate_per_word" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" step="0.01" min="0">
                        </div>

                        <div class="mb-4">
                            <label for="rate_per_hour" class="block text-sm font-medium text-gray-700 mb-1">Rate per Hour ($)</label>
                            <input type="number" name="rate_per_hour" id="rate_per_hour" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" step="0.01" min="0">
                        </div>

                        <div class="mb-4">
                            <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">Availability</label>
                            <select name="availability" id="availability" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- About You Section -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">About You</h2>
                    <div class="mb-4">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea name="bio" id="bio" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Tell clients about your experience, skills, and working style..."></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-center">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-black font-medium rounded-md border-2 border-blue-700 shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Create Your Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
