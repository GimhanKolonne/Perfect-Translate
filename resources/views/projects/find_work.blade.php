<x-app-layout>
    <div class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600 mb-4">Translation Projects</h1>
                <p class="text-xl text-purple-700">Discover and apply for exciting translation opportunities</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-12 transition-all duration-300 hover:shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <form method="get" action="/project/filter" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="original_language" class="block text-sm font-medium text-purple-700 mb-1">Original Language</label>
                                <select name="original_language" id="original_language" class="w-full rounded-lg border-purple-300 focus:border-purple-500 focus:ring focus:ring-purple-200">
                                    <option value="">All Languages</option>
                                    <option value="Sinhala">Sinhala</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="English">English</option>
                                </select>
                            </div>
                            <div>
                                <label for="target_language" class="block text-sm font-medium text-purple-700 mb-1">Target Language</label>
                                <select name="target_language" id="target_language" class="w-full rounded-lg border-purple-300 focus:border-purple-500 focus:ring focus:ring-purple-200">
                                    <option value="">All Languages</option>
                                    <option value="Sinhala">Sinhala</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="English">English</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="submit" class="flex-grow px-6 py-3 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                Apply Filters
                            </button>
                            <a href="{{ route('projects.find-work') }}" class="flex-grow px-6 py-3 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                                Clear All
                            </a>
                        </div>
                    </form>
                    <form method="get" action="/project/search" class="flex flex-col justify-end">
                        <div class="mb-4">
                            <label for="search" class="block text-sm font-medium text-purple-700 mb-1">Search Projects</label>
                            <div class="relative">
                                <input name="search" id="search" value="{{ request()->input('search') }}" class="w-full rounded-lg border-purple-300 focus:border-purple-500 focus:ring focus:ring-purple-200 pl-10" placeholder="Enter keywords...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                            Search Projects
                        </button>
                    </form>
                </div>
            </div>

            <!-- Projects Grid -->
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($projects as $project)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-purple-200 transform hover:-translate-y-2">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-2xl font-bold text-purple-800 mb-2">{{ $project->project_name }}</h3>
                                <span class="px-4 py-2 bg-purple-600 text-white text-sm font-bold rounded-full">
                                    Rs{{ number_format($project->project_budget, 2) }}
                                </span>
                            </div>
                            <p class="text-base text-purple-600 mb-4">{{ Str::limit($project->project_description, 100) }}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $project->project_domain }}</span>
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $project->original_language }} to {{ $project->target_language }}</span>
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">
                                    Status:
                                    <span class="{{ $project->project_status === 'Completed' ? 'text-green-600' : ($project->project_status === 'In Progress' ? 'text-yellow-600' : 'text-blue-600') }}">
                                        {{ $project->project_status }}
                                    </span>
                                </span>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-sm text-purple-600 font-medium">Start: {{ $project->project_start_date ? date('M d, Y', strtotime($project->project_start_date)) : 'N/A' }}</span>
                                <span class="text-sm text-purple-600 font-medium">End: {{ $project->project_end_date ? date('M d, Y', strtotime($project->project_end_date)) : 'N/A' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                @if($project->project_status !== 'Completed')
                                    <span class="text-sm text-purple-600 font-medium">Applications: {{ $project->applications_count }}</span>
                                    <a href="{{route('projects.view-projects', $project->id)}}" class="px-6 py-2 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
                                        View Details
                                    </a>

                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-3xl shadow-lg p-8 border border-purple-200">
                        <p class="text-purple-700 text-center text-lg font-medium">No projects found. Try adjusting your search or filters.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterForm = document.querySelector('form[action="/project/filter"]');
                const searchForm = document.querySelector('form[action="/project/search"]');

                filterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    applyFilters();
                });

                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    applySearch();
                });

                function applyFilters() {
                    const formData = new FormData(filterForm);
                    const params = new URLSearchParams(formData);
                    window.location.href = '/project/filter?' + params.toString();
                }

                function applySearch() {
                    const formData = new FormData(searchForm);
                    const params = new URLSearchParams(formData);
                    window.location.href = '/project/search?' + params.toString();
                }
            });
        </script>
    @endpush
</x-app-layout>
