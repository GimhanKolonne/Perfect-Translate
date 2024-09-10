@extends('layouts.dashboard')

@section('content')

            <!-- Projects Grid -->
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($projects as $project)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-purple-200 transform hover:-translate-y-2">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-2xl font-bold text-purple-800 mb-2">{{ $project->project_name }}</h3>
                                <span class="px-4 py-2 bg-purple-600 text-white text-sm font-bold rounded-full">
                                රු{{ number_format($project->project_budget, 2) }}
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
                            <div class="flex items-center justify-between">
                                @if($project->project_status !== 'Completed' )
                                    <span class="text-sm text-purple-600 font-medium">Applications: {{ $project->applications_count }}</span>
                                    <a href="{{route('projects.view-projects', $project->id)}}" class="px-6 py-2 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
                                        View Details
                                    </a>
                                @endif
                                <div class="flex space-x-2">
                                    @if($project->project_status === 'Completed')
                                        @if(!$project->has_reviewed)
                                            <a href="{{ route('reviews.create.translator', $project->id) }}" class="px-6 py-2 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
                                                Review
                                            </a>
                                        @else
                                            <p class="px-6 py-2 bg-green-500 text-white text-sm font-semibold rounded-lg">
                                                Reviewed
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl shadow-lg p-8 border border-purple-200">
                        <p class="text-purple-700 text-center text-lg font-medium">No projects found</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
@endsection

