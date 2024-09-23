<x-app-layout>
    <div class="bg-gradient-to-b from-purple-100 to-purple-200 min-h-screen">
        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Create Portfolio Item</h1>

            <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white shadow-md rounded-lg p-8">
                @csrf
                <input type="hidden" name="translator_id" value="{{ auth()->user()->translator->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Project Title -->
                    <div class="col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Project Title</label>
                        <input id="title" name="title" type="text" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('title') border-red-500 @enderror"
                               value="{{ old('title') }}"
                               maxlength="255">
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description of Your Role -->
                    <div class="col-span-2">
                        <label for="role_description" class="block text-sm font-medium text-gray-700 mb-1">Description of Your Role</label>
                        <textarea id="role_description" name="role_description" required rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('role_description') border-red-500 @enderror"
                                  maxlength="1000">{{ old('role_description') }}</textarea>
                        @error('role_description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Overview -->
                    <div class="col-span-2">
                        <label for="overview" class="block text-sm font-medium text-gray-700 mb-1">Project Overview</label>
                        <textarea id="overview" name="overview" required rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('overview') border-red-500 @enderror"
                                  maxlength="2000">{{ old('overview') }}</textarea>
                        @error('overview')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Relevant Skills -->
                    <div>
                        <label for="relevant_skills" class="block text-sm font-medium text-gray-700 mb-1">Relevant Skills</label>
                        <textarea id="relevant_skills" name="relevant_skills" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('relevant_skills') border-red-500 @enderror"
                                  maxlength="500">{{ old('relevant_skills') }}</textarea>
                        @error('relevant_skills')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Project Tags (optional)</label>
                        <textarea id="tags" name="tags" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('tags') border-red-500 @enderror"
                                  placeholder="Enter tags separated by commas"
                                  maxlength="255">{{ old('tags') }}</textarea>
                        @error('tags')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Media -->
                    <div class="col-span-2">
                        <label for="media" class="block text-sm font-medium text-gray-700 mb-1">Upload Media (images, videos, documents)</label>
                        <input id="media" name="media[]" type="file" multiple
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('media.*') border-red-500 @enderror"
                               accept="image/*,video/*,.pdf,.doc,.docx">
                        @error('media.*')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Detailed Description -->
                    <div class="col-span-2">
                        <label for="detailed_description" class="block text-sm font-medium text-gray-700 mb-1">Detailed Description</label>
                        <textarea id="detailed_description" name="detailed_description" required rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('detailed_description') border-red-500 @enderror"
                                  maxlength="5000">{{ old('detailed_description') }}</textarea>
                        @error('detailed_description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 @error('status') border-red-500 @enderror">
                            <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit"
                            class="w-full py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out">
                        Save Portfolio Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
