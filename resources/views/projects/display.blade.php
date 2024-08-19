<x-app-layout>
    <div class="py-12 bg-gradient-to-r from-purple-200 via-purple-300 to-purple-400 min-h-screen">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Header Section -->
                <div class="p-8">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 md:gap-6">
                        <a href="{{ route('projects.display-projects') }}" class="text-3xl font-bold text-gray-900">Projects</a>

                        <div class="flex flex-col md:flex-row gap-4 md:gap-6">
                            <!-- Filter and Search Forms -->
                            <div class="flex flex-col md:flex-row gap-4">
                                <form method="get" action="/project/filter" class="flex flex-col md:flex-row items-start gap-2 md:gap-4">
                                    <select name="original_language" class="text-sm border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option value="">Original Language</option>
                                        <option value="Sinhala">Sinhala</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="English">English</option>
                                    </select>

                                    <select name="target_language" class="text-sm border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option value="">Target Language</option>
                                        <option value="Sinhala">Sinhala</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="English">English</option>
                                    </select>

                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-white text-purple-700 border border-purple-300 rounded-full text-sm font-semibold uppercase tracking-widest hover:bg-purple-100 transition duration-300">
                                        Filter
                                    </button>
                                </form>

                                <form method="get" action="/project/search" class="flex items-center gap-2">
                                    <input name="search" value="{{ request()->input('search') }}" class="form-control bg-white text-purple-700 border border-purple-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Search Projects">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-white text-purple-700 border border-purple-300 rounded-full text-sm font-semibold uppercase tracking-widest hover:bg-purple-100 transition duration-300">
                                        Search
                                    </button>
                                </form>
                            </div>

                            <!-- New Buttons for Applications -->
                            <div class="flex flex-col md:flex-row gap-2 md:gap-4 overflow-x-auto">
                                <a href="{{ route('projects.sent-applications') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-full text-xs font-semibold uppercase tracking-widest hover:bg-blue-700 transition duration-300">
                                    My Applications
                                </a>
                                <a href="{{ route('projects.accepted-applications') }}" class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white rounded-full text-xs font-semibold uppercase tracking-widest hover:bg-green-700 transition duration-300">
                                    Accepted Applications
                                </a>
                                <a href="{{ route('projects.completed-applications') }}" class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white rounded-full text-xs font-semibold uppercase tracking-widest hover:bg-purple-700 transition duration-300">
                                    Completed Projects
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @forelse ($projects as $project)
                            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $project->project_name }}</h3>
                                        <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                            රු{{ number_format($project->project_budget, 2) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($project->project_description, 100) }}</p>

                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $project->project_domain }}</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $project->original_language }} to {{ $project->target_language }}</span>
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            Status:
                                            <span class="{{ $project->project_status === 'Completed' ? 'text-green-600' : ($project->project_status === 'In Progress' ? 'text-yellow-600' : 'text-blue-600') }}">
                                                {{ $project->project_status }}
                                            </span>
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        @if($project->project_status !== 'Completed' )
                                            <span class="text-sm text-gray-600">Applications: {{ $project->applications_count }}</span>
                                            <a href="{{route('projects.view-projects', $project->id)}}" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                                View Details
                                            </a>
                                        @endif

                                        <div class="flex space-x-2">
{{--                                            @if($project->project_status === 'Completed' && !$project->has_reviewed)--}}
{{--                                                <button onclick="openModal({{ $project->id }})" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">--}}
{{--                                                    Review--}}
{{--                                                </button>--}}
{{--                                            @else--}}
{{--                                                <p class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition">--}}
{{--                                                    Reviewed--}}
{{--                                                </p>--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-lg shadow-md p-6">
                                <p class="text-gray-700 text-center">No completed projects found</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="px-8 py-4">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
