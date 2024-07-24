<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-purple-400 to-purple-600 p-6 p-6">
                <h1 class="text-3xl font-bold text-white text-center">Create Your Client Profile</h1>
            </div>

            <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Company Details Section -->
                    <div>
                        <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Company Details</h2>

                        <div class="mb-4">
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                            <input type="text" name="company_name" id="company_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required maxlength="255">
                        </div>

                        <div class="mb-4">
                            <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">Contact Name *</label>
                            <input type="text" name="contact_name" id="contact_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required maxlength="255">
                        </div>

                        <div class="mb-4">
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Contact Phone *</label>
                            <input type="tel" name="contact_phone" id="contact_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required pattern="[0-9]{10}" title="Please enter a valid phone number">
                        </div>

                        <div class="mb-4">
                            <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Company Address *</label>
                            <textarea name="company_address" id="company_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required maxlength="500"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                            <input type="text" name="country" id="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required maxlength="100">
                        </div>

                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" id="website" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"  title="Please enter a valid URL" placeholder="www.perfecttranslate.com">
                        </div>

                        <div class="mb-4">
                            <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry *</label>
                            <input type="text" name="industry" id="industry" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required maxlength="100">
                        </div>
                    </div>

                    <!-- About You Section -->
                    <div>
                        <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">About You</h2>

                        <div class="mb-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio *</label>
                            <textarea name="bio" id="bio" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required placeholder="Tell us about your company, goals, and services..." maxlength="1000"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-center">
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-purple-400 to-purple-600 p-6 text-black font-medium rounded-md border-2  shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Create Your Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
