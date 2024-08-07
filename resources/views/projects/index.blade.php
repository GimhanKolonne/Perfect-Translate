<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-gradient-to-r from-purple-500 to-purple-700 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl text-white font-bold">Projects</h2>
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm uppercase tracking-widest hover:bg-purple-100 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Add Project
                        </a>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white">
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
                                    <span class="text-sm font-semibold text-purple-800">Status: {{($project->project_status)}}</span>
                                    <div class="flex items-center">
                                        <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full hover:bg-purple-700 transition duration-300 mr-2">View Details</a>
                                        <button onclick="openDeleteModal({{ $project->id }})" class="text-red-600 hover:text-red-800 transition duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow-md p-6 col-span-full">
                            <p class="text-gray-700 text-center">No projects found. Create your first project!</p>
                        </div>
                    @endforelse
                </div>

                <div class="px-6 py-4">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden">
            <div class="bg-white rounded-lg shadow-lg max-w-sm w-full">
                <div class="p-4 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Delete Project</h3>
                </div>
                <div class="p-4">
                    <p class="text-sm text-gray-500">Are you sure you want to delete this project? This action cannot be undone.</p>
                </div>
                <div class="p-4 flex justify-end gap-2 border-t">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
                    </form>
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancel</button>
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
    </div>
</x-app-layout>
