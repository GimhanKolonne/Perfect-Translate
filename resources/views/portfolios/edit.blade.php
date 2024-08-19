<x-app-layout>
    <div class="bg-gradient-to-b from-purple-100 to-purple-200">
        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Edit Portfolio Item</h1>

            <form action="{{ route('portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white shadow-md rounded-lg p-8">
                @csrf
                @method('PUT')
                <input type="hidden" name="translator_id" value="{{ $portfolio->translator_id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Project Title -->
                    <div class="col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Project Title</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $portfolio->title) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description of Your Role -->
                    <div class="col-span-2">
                        <label for="role_description" class="block text-sm font-medium text-gray-700 mb-1">Description of Your Role</label>
                        <textarea id="role_description" name="role_description" required rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('role_description', $portfolio->role_description) }}</textarea>
                        @error('role_description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Overview -->
                    <div class="col-span-2">
                        <label for="overview" class="block text-sm font-medium text-gray-700 mb-1">Project Overview</label>
                        <textarea id="overview" name="overview" required rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('overview', $portfolio->overview) }}</textarea>
                        @error('overview')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Relevant Skills -->
                    <div>
                        <label for="relevant_skills" class="block text-sm font-medium text-gray-700 mb-1">Relevant Skills</label>
                        <textarea id="relevant_skills" name="relevant_skills" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('relevant_skills', $portfolio->relevant_skills) }}</textarea>
                        @error('relevant_skills')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Project Tags (optional)</label>
                        <textarea id="tags" name="tags" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                                  placeholder="Enter tags separated by commas">{{ old('tags', $portfolio->tags) }}</textarea>
                        @error('tags')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Media -->
                    <div class="col-span-2">
                        <label for="media" class="block text-sm font-medium text-gray-700 mb-1">Upload Media (images, videos, documents)</label>
                        <input id="media" name="media[]" type="file" multiple
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                        @error('media.*')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Detailed Description -->
                    <div class="col-span-2">
                        <label for="detailed_description" class="block text-sm font-medium text-gray-700 mb-1">Detailed Description</label>
                        <textarea id="detailed_description" name="detailed_description" required rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('detailed_description', $portfolio->detailed_description) }}</textarea>
                        @error('detailed_description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                            <option value="Draft" {{ old('status', $portfolio->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Published" {{ old('status', $portfolio->status) == 'Published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 space-x-4">
                    <a href="{{ route('translators.show', $translator) }}" class="w-1/2 py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out">
                        Cancel
                    </a>

                    <button type="submit"
                            class="w-1/2 py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out">
                        Update Portfolio Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

