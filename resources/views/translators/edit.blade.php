<x-app-layout>
    <div class="bg-gradient-to-b from-purple-100 to-white min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-purple-800 h-40 flex items-center justify-center">
                    <h1 class="text-4xl font-extrabold text-white text-center">Edit Your Translator Profile</h1>
                </div>
                <form action="{{ route('translators.update', $translator) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <!-- Type of Translator -->
                        <div class="bg-purple-50 rounded-xl shadow-lg border border-purple-200 p-6 transition duration-300 hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">{{ __('Type of Translator') }}</h3>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach(['General', 'Technical', 'Legal', 'Medical', 'Literary', 'Financial'] as $type)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="type_of_translator[]" id="type_{{ $type }}" value="{{ $type }}"
                                               class="rounded border-purple-300 text-purple-600 focus:ring-purple-500"
                                            {{ in_array($type, $translator->type_of_translator) ? 'checked' : '' }}>
                                        <label for="type_{{ $type }}" class="ml-2 text-sm text-gray-700">{{ $type }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Language Skills -->
                        <div class="bg-purple-50 rounded-xl shadow-lg border border-purple-200 p-6 transition duration-300 hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">{{ __('Language Pairs') }}</h3>
                            <div class="grid grid-cols-2 gap-3">
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
                                        <input type="checkbox" name="language_pairs[]" id="pair_{{ str_replace(' ', '_', $pair) }}" value="{{ $pair }}"
                                               class="rounded border-purple-300 text-purple-600 focus:ring-purple-500"
                                            {{ in_array($pair, $translator->language_pairs) ? 'checked' : '' }}>
                                        <label for="pair_{{ str_replace(' ', '_', $pair) }}" class="ml-2 text-sm text-gray-700">{{ $pair }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Professional Details -->
                        <div class="bg-purple-50 rounded-xl shadow-lg border border-purple-200 p-6 transition duration-300 hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">{{ __('Professional Details') }}</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="years_of_experience" class="block text-sm font-medium text-gray-700">Years of Experience</label>
                                    <input type="number" name="years_of_experience" id="years_of_experience"
                                           value="{{ old('years_of_experience', $translator->years_of_experience) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="rate_per_word" class="block text-sm font-medium text-gray-700">Rate per Word ($)</label>
                                    <input type="number" name="rate_per_word" id="rate_per_word"
                                           value="{{ old('rate_per_word', $translator->rate_per_word) }}" step="0.01" min="0"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="rate_per_hour" class="block text-sm font-medium text-gray-700">Rate per Hour ($)</label>
                                    <input type="number" name="rate_per_hour" id="rate_per_hour"
                                           value="{{ old('rate_per_hour', $translator->rate_per_hour) }}" step="0.01" min="0"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                                    <select name="availability" id="availability"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                        <option value="Full-time" {{ old('availability', $translator->availability) === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                        <option value="Part-time" {{ old('availability', $translator->availability) === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- About You -->
                        <div class="bg-purple-50 rounded-xl shadow-lg border border-purple-200 p-6 transition duration-300 hover:shadow-xl">
                            <h3 class="text-xl font-semibold text-purple-800 mb-4">{{ __('About You') }}</h3>
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <textarea name="bio" id="bio" rows="6"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                                          placeholder="Tell clients about your experience, skills, and working style...">{{ old('bio', $translator->bio) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-10 flex justify-end">
                        <button type="submit"
                                class="px-8 py-4 bg-gradient-to-r from-purple-600 to-purple-800 text-white text-lg font-semibold rounded-full shadow-lg hover:from-purple-700 hover:to-purple-900 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105">
                            {{ __('Update Profile') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
