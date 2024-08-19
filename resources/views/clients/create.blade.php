<x-app-layout>
    <div class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8"
         x-data="{
            step: 1,
            companyName: '',
            contactName: '',
            contactPhone: '',
            companyAddress: '',
            country: '',
            website: '',
            industry: '',
            bio: '',
            errors: {
                companyName: '',
                contactName: '',
                contactPhone: '',
                companyAddress: '',
                country: '',
                website: '',
                industry: '',
                bio: ''
            },
            validateStep() {
                this.errors = {
                    companyName: '',
                    contactName: '',
                    contactPhone: '',
                    companyAddress: '',
                    country: '',
                    website: '',
                    industry: '',
                    bio: ''
                };
                let isValid = true;

                if (this.step === 1) {
                    if (!this.companyName.trim()) {
                        this.errors.companyName = 'Company name is required.';
                        isValid = false;
                    }
                    if (!this.contactName.trim()) {
                        this.errors.contactName = 'Contact name is required.';
                        isValid = false;
                    }
                    if (!this.contactPhone.trim() || !/^[0-9]{10}$/.test(this.contactPhone)) {
                        this.errors.contactPhone = 'Valid contact phone is required.';
                        isValid = false;
                    }
                } else if (this.step === 2) {
                    if (!this.companyAddress.trim()) {
                        this.errors.companyAddress = 'Company address is required.';
                        isValid = false;
                    }
                    if (!this.country.trim()) {
                        this.errors.country = 'Country is required.';
                        isValid = false;
                    }
                    if (this.website && !/^https?:\/\/.+/.test(this.website)) {
                        this.errors.website = 'Please enter a valid URL.';
                        isValid = false;
                    }
                } else if (this.step === 3) {
                    if (!this.industry.trim()) {
                        this.errors.industry = 'Industry is required.';
                        isValid = false;
                    }
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
                <h1 class="text-3xl font-bold text-white text-center">Create Your Client Profile</h1>
            </div>

            <!-- Progress Bar -->
            <div class="px-6 pt-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-purple-600 h-2.5 rounded-full"
                         :style="{ width: (step / 3 * 100) + '%' }"
                         x-transition></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Company Info</span>
                    <span>Contact Details</span>
                    <span>About You</span>
                </div>
            </div>

            <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8" @submit="submitForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <!-- Step 1: Company Info -->
                <div x-show="step === 1" x-transition>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 gradient-text">Company Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                            <input type="text" name="company_name" id="company_name" x-model="companyName"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.companyName"></div>
                        </div>
                        <div>
                            <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">Contact Name</label>
                            <input type="text" name="contact_name" id="contact_name" x-model="contactName"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.contactName"></div>
                        </div>
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Contact Phone</label>
                            <input type="tel" name="contact_phone" id="contact_phone" x-model="contactPhone"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.contactPhone"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Contact Details -->
                <div x-show="step === 2" x-transition>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 gradient-text">Contact Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Company Address</label>
                            <textarea name="company_address" id="company_address" rows="3" x-model="companyAddress"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300"></textarea>
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.companyAddress"></div>
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <input type="text" name="country" id="country" x-model="country"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.country"></div>
                        </div>
                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" id="website" x-model="website"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.website"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: About You -->
                <div x-show="step === 3" x-transition>
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800 gradient-text">About Your Company</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                            <input type="text" name="industry" id="industry" x-model="industry"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300">
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.industry"></div>
                        </div>
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea name="bio" id="bio" rows="4" x-model="bio"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-300"
                                      placeholder="Tell us about your company, goals, and services..."></textarea>
                            <div class="mt-2 text-red-600 text-sm" x-text="errors.bio"></div>
                        </div>
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
                            x-show="step < 3">
                        Next
                    </button>
                    <button type="submit" x-show="step === 3"
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
