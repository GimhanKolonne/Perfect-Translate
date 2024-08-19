<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-purple-800 h-32">
                    <h1 class="text-3xl font-bold text-white text-center pt-8">Edit Your Client Profile</h1>
                </div>
                <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="px-4 sm:px-6 lg:px-8 py-8">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Company Details -->
                            <div class="bg-white rounded-lg shadow-lg border border-gray-300 p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Company Details') }}</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $client->company_name) }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    </div>
                                    <div>
                                        <label for="contact_name" class="block text-sm font-medium text-gray-700">Contact Name</label>
                                        <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $client->contact_name) }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    </div>
                                    <div>
                                        <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                                        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $client->contact_phone) }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    </div>
                                    <div>
                                        <label for="company_address" class="block text-sm font-medium text-gray-700">Company Address</label>
                                        <input type="text" name="company_address" id="company_address" value="{{ old('company_address', $client->company_address) }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="bg-white rounded-lg shadow-lg border border-gray-300 p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Details') }}</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                        <input type="text" name="country" id="country" value="{{ old('country', $client->country) }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    </div>
                                    <div>
                                        <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                        <input type="text" name="website" id="website" value="{{ old('website', $client->website) }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    </div>
                                    <div>
                                        <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                                        <input type="text" name="industry" id="industry" value="{{ old('industry', $client->industry) }}"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    </div>
                                </div>
                            </div>

                            <!-- About You -->
                            <div class="bg-white rounded-lg shadow-lg border border-gray-300 p-6 md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('About You') }}</h3>
                                <div>
                                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                    <textarea name="bio" id="bio" rows="4"
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                                              placeholder="Tell translators about your company, projects, and requirements...">{{ old('bio', $client->bio) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 flex justify-end">
                            <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-800 text-white font-medium rounded-md shadow-sm hover:from-purple-700 hover:to-purple-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
