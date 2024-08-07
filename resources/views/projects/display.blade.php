<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Header Section -->
                <div class="p-6 bg-gradient-to-r from-purple-500 to-purple-700 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <h2 class="text-3xl text-white font-bold mb-4 md:mb-0">Projects</h2>

                        <div class="flex flex-col md:flex-row gap-4 md:gap-6">
                            <form method="get" action="/project/filter" class="flex flex-col md:flex-row gap-4">
                                <select name="original_language" class="form-select bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    <option value="">Select Original Language</option>
                                    <option value="Sinhala">Sinhala</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="English">English</option>
                                </select>

                                <select name="target_language" class="form-select bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    <option value="">Select Target Language</option>
                                    <option value="Sinhala">Sinhala</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="English">English</option>
                                </select>

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm uppercase tracking-widest hover:bg-purple-100 transition duration-300">
                                    Filter
                                </button>
                            </form>

                            <form method="get" action="/project/search" class="flex items-center gap-4">
                                <input name="search" value="{{ request()->input('search') }}" class="form-control bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" placeholder="Search For Projects">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm uppercase tracking-widest hover:bg-purple-100 transition duration-300">
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Projects Grid -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-white">
                    @forelse ($projects as $project)
                        <div class="bg-purple-100 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                            <div class="p-6">
                                <div class="font-bold text-xl mb-2 text-purple-800">{{ $project->project_name }}</div>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->project_description, 100) }}</p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="bg-purple-100 rounded-full px-3 py-1 text-xs font-semibold text-purple-700">{{ $project->project_domain }}</span>
                                    <span class="bg-purple-100 rounded-full px-3 py-1 text-xs font-semibold text-purple-700">{{ $project->original_language }} to {{ $project->target_language }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-semibold text-purple-800">Budget: රු{{ number_format($project->project_budget, 2) }}</span>
                                    <span class="text-sm font-semibold text-purple-800">Status: {{ $project->project_status }}</span>
                                    <div class="flex items-center">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-semibold rounded-md shadow-md hover:bg-purple-700 transition duration-300">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow-md p-6 col-span-full">
                            <p class="text-gray-700 text-center">No projects found</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
