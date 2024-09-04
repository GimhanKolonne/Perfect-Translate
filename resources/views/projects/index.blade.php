@extends('layouts.client-dashboard')

@section('content')
        <div class="max-w-7xl mx-auto ">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Your Translation Projects</h2>

                        @if($verified === 'Verified')
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-800 focus:outline-none focus:border-purple-800 focus:ring focus:ring-purple-300 disabled:opacity-25 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Post a Job
                            </a>
                        @else
                            <p class="text-sm text-gray-800 bg-purple-100 px-4 py-2 rounded-md">Verify your account to post jobs</p>
                        @endif
                    </div>
                    <div class="mb-6">
                        <form action="{{ route('projects.filter') }}" method="GET" class="flex items-center space-x-4">
                            <select name="status" class="text-sm border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                Filter
                            </button>
                            @if(request('status'))
                                <a href="{{ route('projects.filter') }}" class="text-sm text-purple-600 hover:text-purple-800">Clear Filter</a>
                            @endif
                        </form>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
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
                                        @if($project->project_status !== 'Completed')

                                        <span class="text-sm text-gray-600">Applications: {{ $project->applications_count }}</span>
                                        @endif

                                        <div class="flex space-x-2">
                                            @if($project->project_status !== 'Completed')

                                            <a href="{{ route('applications.index', $project->id) }}" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                                View Applications
                                            </a>
                                                <a href="{{ route('projects.edit', $project->id) }}" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                                    Edit
                                                </a>
                                            @endif
                                                @if($project->project_status === 'Completed')
                                                    @if(!$project->has_reviewed)
                                                        <a href="{{ route('reviews.create', $project->id) }}" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                                            Review
                                                        </a>
                                                    @else
                                                        <p class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                                            Reviewed
                                                        </p>
                                                    @endif
                                                @endif


                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4">
                                    @if($project->project_status !== 'Completed')

                                    <form action="{{ route('projects.update-status', $project->id) }}" method="POST" class="flex items-center justify-between">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status" class="text-sm border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <option value="Pending" {{ $project->project_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="In Progress" {{ $project->project_status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Completed" {{ $project->project_status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Cancelled" {{ $project->project_status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="ml-2 px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                            Update
                                        </button>
                                    </form>
                                    @endif
                                    <button onclick="openDeleteModal({{ $project->id }})" class="mt-2 w-full px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-lg shadow-md p-6">
                                <p class="text-gray-700 text-center">No projects found. Start by creating a new project!</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" x-data="{ open: false }">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Project</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this project? This action cannot be undone.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Delete
                        </button>
                    </form>
                    <button onclick="closeDeleteModal()" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openDeleteModal(projectId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = '{{ route('projects.destroy', '') }}/' + projectId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }


    </script>
@endsection
