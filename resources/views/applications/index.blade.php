<x-app-layout>
    <div class="py-12 bg-gradient-to-r from-purple-200 via-purple-300 to-purple-400 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Applications for {{ $project->project_name }}</h2>

                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 bg-purple-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-purple-800 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition duration-150 ease-in-out">
                            Back to Projects
                        </a>
                    </div>

                    <!-- Filter Form -->
                    <div class="mb-6">
                        <form action="{{ route('applications.index', ['projectId' => $project->id]) }}" method="GET" class="flex items-center space-x-4">
                            <select name="status" class="text-sm border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Accepted" {{ request('status') === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="Declined" {{ request('status') === 'Declined' ? 'selected' : '' }}>Declined</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                Filter
                            </button>
                            @if(request('status'))
                                <a href="{{ route('applications.index', ['projectId' => $project->id]) }}" class="text-sm text-purple-600 hover:text-purple-800">Clear Filter</a>
                            @endif
                        </form>
                    </div>

                    <!-- Applications List -->
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @forelse ($applications as $application)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-shadow duration-300 hover:shadow-lg">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        @if ($application->translator && $application->translator->user)
                                            <div>
                                                <p class="text-lg font-semibold text-gray-900">
                                                    <a href="{{ route('translators.display-profile', $application->translator->id) }}" class="hover:underline">
                                                        {{ $application->translator->user->name }}
                                                    </a>
                                                </p>

                                                <p class="text-gray-600">Contact Email: {{ $application->contact_email }}</p>
                                                <p class="text-gray-600">Contact No: {{ $application->contact_phone }}</p>
                                                <p class="text-gray-600">Proficiency Level: {{ $application->language_proficiency }}</p>
                                                <p class="text-gray-600">Message: {{ $application->application_message }}</p>
                                                <p class="text-gray-600">Status: {{ $application->status }}</p>
                                            </div>
                                        @elseif ($application->translator)
                                            <p class="text-orange-600">Translator details missing</p>
                                        @else
                                            <p class="text-red-600">Translator not found</p>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($application->details, 100) }}</p>

                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @if($application->cv)
                                            <a href="{{ asset('storage/' . $application->cv) }}" class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full hover:bg-purple-700 transition duration-300" download>
                                                Download CV
                                            </a>
                                        @else
                                            <span class="text-red-600">No CV uploaded</span>
                                        @endif
                                    </div>

                                    @unless(request()->query('status'))
                                        <div class="flex justify-end mt-4 space-x-2">
                                            <!-- Accept Button -->
                                            <form action="{{ route('applications.accept', $application->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition duration-300">
                                                    Accept
                                                </button>
                                            </form>

                                            <!-- Decline Button -->
                                            <form action="{{ route('applications.decline', $application->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-fuchsia-600 text-white text-sm font-medium rounded-md hover:bg-fuchsia-700 transition duration-300">
                                                    Decline
                                                </button>
                                            </form>

                                            <!-- Delete Button -->
                                            <button onclick="openDeleteModal({{ $application->id }})" class="px-4 py-2 bg-purple-800 text-white text-sm font-medium rounded-md hover:bg-purple-900 transition duration-300">
                                                Delete
                                            </button>
                                        </div>
                                    @endunless
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-lg shadow-md p-6">
                                <p class="text-gray-700 text-center">No applications found.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" x-data="{ open: false }">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Application</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Are you sure you want to delete this application? This action cannot be undone.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300">Delete</button>
                    </form>
                    <button onclick="closeDeleteModal()" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(applicationId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = '{{ route('applications.destroy', '') }}/' + applicationId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
