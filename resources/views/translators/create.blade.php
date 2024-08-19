<x-app-layout>
    <div class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8"
         x-data="{
            step: 1,
            expertise: [],
            languagePairs: [],
            yearsOfExperience: '',
            ratePerWord: '',
            ratePerHour: '',
            availability: 'Full-time',
            bio: '',
            errors: {
                expertise: '',
                languagePairs: '',
                yearsOfExperience: '',
                ratePerWord: '',
                ratePerHour: '',
                availability: '',
                bio: ''
            },
            validateStep() {
                this.errors = {
                    expertise: '',
                    languagePairs: '',
                    yearsOfExperience: '',
                    ratePerWord: '',
                    ratePerHour: '',
                    availability: '',
                    bio: ''
                };
                let isValid = true;

                if (this.step === 1) {
                    if (this.expertise.length === 0) {
                        this.errors.expertise = 'Please select at least one area of expertise.';
                        isValid = false;
                    }
                } else if (this.step === 2) {
                    if (this.languagePairs.length === 0) {
                        this.errors.languagePairs = 'Please select at least one language pair.';
                        isValid = false;
                    }
                } else if (this.step === 3) {
                    if (this.yearsOfExperience <= 0) {
                        this.errors.yearsOfExperience = 'Years of experience is required.';
                        isValid = false;
                    }
                    if (this.ratePerWord <= 0) {
                        this.errors.ratePerWord = 'Rate per word is required.';
                        isValid = false;
                    }
                    if (this.ratePerHour <= 0) {
                        this.errors.ratePerHour = 'Rate per hour is required.';
                        isValid = false;
                    }
                    if (!this.availability) {
                        this.errors.availability = 'Availability is required.';
                        isValid = false;
                    }
                } else if (this.step === 4) {
                    if (!this.bio.trim()) {
                        this.errors.bio = 'Bio is required.';
                        isValid = false;
                    }
                }

                return isValid;
            },
            goNext() {
                if (this.validateStep()) {
                    this.step++;
                }
            },
            goBack() {
                if (this.step > 1) {
                    this.step--;
                }
            },
            submitForm(event) {
                if (!this.validateStep()) {
                    event.preventDefault();
                    return;
                }
            }
         }">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up">
            <div class="bg-gradient-to-r from-purple-600 to-purple-300 p-6">
                <h1 class="text-3xl font-bold text-white text-center">Create Your Translator Profile</h1>
            </div>

            <!-- Progress Bar -->
            <div class="px-6 pt-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-purple-600 h-2.5 rounded-full"
                         :style="{ width: (step / 4 * 100) + '%' }"
                         x-transition></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Expertise</span>
                    <span>Languages</span>
                    <span>Details</span>
                    <span>About You</span>
                </div>
            </div>

            <form action="{{ route('translators.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8" @submit="submitForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <!-- Step 1: Expertise -->
                <div x-show="step === 1" x-transition>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 gradient-text">What's your expertise?</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['Technical', 'Medical', 'Literary', 'Financial'] as $type)
                            <div class="flex items-center p-4 border-2 border-gray-300 rounded-lg hover:bg-purple-50 transition duration-300"
                                 :class="{ 'border-purple-500 bg-purple-50': expertise.includes('{{ $type }}') }"
                                 @click="expertise.includes('{{ $type }}') ? expertise = expertise.filter(e => e !== '{{ $type }}') : expertise.push('{{ $type }}')">
                                <input type="checkbox" name="type_of_translator[]" id="type_{{ $type }}" value="{{ $type }}" x-model="expertise" class="hidden">
                                <label for="type_{{ $type }}" class="ml-2 text-sm text-gray-700 cursor-pointer">{{ $type }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-2 text-red-600 text-sm" x-text="errors.expertise"></div>
                </div>

                <!-- Step 2: Language Skills -->
                <div x-show="step === 2" x-transition>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 gradient-text">What languages do you translate?</h2>
                    <div class="grid grid-cols-2 gap-4">
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
                            <div class="flex items-center p-4 border-2 border-gray-300 rounded-lg hover:bg-purple-50 transition duration-300"
                                 :class="{ 'border-purple-500 bg-purple-50': languagePairs.includes('{{ $pair }}') }"
                                 @click="languagePairs.includes('{{ $pair }}') ? languagePairs = languagePairs.filter(p => p !== '{{ $pair }}') : languagePairs.push('{{ $pair }}')">
                                <input type="checkbox" name="language_pairs[]" id="pair_{{ str_replace(' ', '_', $pair) }}" value="{{ $pair }}" x-model="languagePairs" class="hidden">
                                <label for="pair_{{ str_replace(' ', '_', $pair) }}" class="ml-2 text-sm text-gray-700 cursor-pointer">{{ $pair }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-2 text-red-600 text-sm" x-text="errors.languagePairs"></div>
                </div>

                <!-- Step 3: Professional Details -->
                <div x-show="step === 3" x-transition>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 gradient-text">Professional Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="years_of_experience" class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                            <input type="number" name="years_of_experience" id="years_of_experience" x-model="yearsOfExperience"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300" min="0">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.yearsOfExperience"></div>
                        </div>
                        <div>
                            <label for="rate_per_word" class="block text-sm font-medium text-gray-700 mb-1">Rate per Word</label>
                            <input type="number" name="rate_per_word" id="rate_per_word" x-model="ratePerWord"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300" step="0.01" min="0" placeholder="In Rupees">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.ratePerWord"></div>
                        </div>
                        <div>
                            <label for="rate_per_hour" class="block text-sm font-medium text-gray-700 mb-1">Rate per Hour </label>
                            <input type="number" name="rate_per_hour" id="rate_per_hour" x-model="ratePerHour"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300" step="0.01" min="0" placeholder="In Rupees">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.ratePerHour"></div>
                        </div>
                        <div>
                            <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">Availability</label>
                            <select name="availability" id="availability" x-model="availability"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300">
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                            </select>
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.availability"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: About You -->
                <div x-show="step === 4" x-transition>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 gradient-text">Tell us about yourself</h2>
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea name="bio" id="bio" rows="4" x-model="bio"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300"
                                  placeholder="Tell clients about your experience, skills, and working style..."></textarea>
                        <div class="mt-2 text-red-600 text-sm" x-text="errors.bio"></div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-8 flex justify-between">
                    <button type="button" @click="goBack()"
                            class="px-4 py-2 border-2 border-gray-300 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition duration-300"
                            x-show="step > 1">
                        Previous
                    </button>
                    <button type="button" @click="goNext()"
                            class="px-4 py-2 border-2 border-purple-600 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition duration-300"
                            x-show="step < 4">
                        Next
                    </button>
                    <button type="submit" x-show="step === 4"
                            class="px-6 py-3 border-2 border-gradient-to-r from-purple-500 to-indigo-600 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium rounded-full shadow hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300">
                        Create Your Profile
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .gradient-text {
            background: linear-gradient(45deg, #6b46c1, #4299e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>
