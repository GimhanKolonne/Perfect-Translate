@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Project Management</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-md">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        @if ($projects->isEmpty())
            <div class="mt-8 text-center text-gray-500 bg-white p-6 rounded-lg shadow-md">
                <p>No accepted projects found.</p>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Project Name</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($projects as $project)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $project->project_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $project->project_status === 'Completed' ? 'bg-green-100 text-green-800' :
                                       ($project->project_status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' :
                                       'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($project->project_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                    <button onclick="toggleProjectDetails({{ $project->id }})" class="text-blue-600 hover:text-blue-900 focus:outline-none focus:underline">
                                        Phase Details
                                    </button>
                                    <a href="{{ route('projects.view-projects', $project->id) }}" class="text-blue-600 hover:text-blue-900 focus:outline-none focus:underline">
                                        View Details
                                    </a>
                                    <a href="{{ route('chat.index', $project->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                        Chat
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr id="project-details-{{ $project->id }}" class="hidden bg-gray-50">
                            <td colspan="3" class="px-6 py-4">
                                <div class="space-y-4">
                                    @if ($project->sprints()->count() === 0)
                                        <form action="{{ route('projects.setSprints', $project->id) }}" method="POST" class="flex items-center space-x-2" onsubmit="return validateSprintsForm(this)">
                                            @csrf
                                            <div class="flex-grow">
                                                <input type="number" name="number_of_sprints" id="number_of_sprints_{{ $project->id }}" placeholder="Number of phases"
                                                       class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required min="1" max="10">
                                                <p class="mt-1 text-sm text-red-600 hidden" id="sprints_error_{{ $project->id }}"></p>
                                            </div>
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                                Set Phases
                                            </button>
                                        </form>
                                    @else
                                        @foreach ($project->sprints as $sprint)
                                            <div class="bg-white p-4 rounded-md shadow-sm border border-gray-200">
                                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Phase {{ $sprint->sprint_number }}</h4>
                                                @if (empty($sprint->description))
                                                    <form action="{{ route('sprints.updateProgress', $sprint->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3" onsubmit="return validateProgressForm(this)">
                                                        @csrf
                                                        <div>
                                                            <textarea name="description" id="description_{{ $sprint->id }}" placeholder="Progress description" rows="3"
                                                                      class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required minlength="10" maxlength="1000"></textarea>
                                                            <p class="mt-1 text-sm text-red-600 hidden" id="description_error_{{ $sprint->id }}"></p>
                                                        </div>
                                                        <div class="flex items-center space-x-2">
                                                            <label class="block text-sm font-medium text-gray-700">
                                                                Progress Document (PDF only, max 5MB)
                                                                <input type="file" name="progress_document" id="progress_document_{{ $sprint->id }}" class="mt-1 block w-full text-sm text-gray-500
                                                                    file:mr-4 file:py-2 file:px-4
                                                                    file:rounded-full file:border-0
                                                                    file:text-sm file:font-semibold
                                                                    file:bg-blue-50 file:text-blue-700
                                                                    hover:file:bg-blue-100" accept=".pdf">
                                                            </label>
                                                        </div>
                                                        <p class="mt-1 text-sm text-red-600 hidden" id="document_error_{{ $sprint->id }}"></p>
                                                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                                            Submit Progress
                                                        </button>
                                                    </form>
                                                @else
                                                    <p class="text-sm text-gray-600 mb-2">{{ $sprint->description }}</p>
                                                    @if ($sprint->progress_document)
                                                        <a href="{{ asset('storage/' . $sprint->progress_document) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium focus:outline-none focus:underline" target="_blank" rel="noopener noreferrer">View Document</a>
                                                    @endif
                                                    <div class="mt-2">
                                                        <a href="{{ route('sprints.edit', $sprint->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 focus:outline-none focus:underline">Edit Progress</a>
                                                    </div>
                                                @endif

                                                <div class="mt-3 pt-3 border-t border-gray-200">
                                                    <h5 class="text-sm font-medium text-gray-900">Feedback:</h5>
                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ !empty($sprint->feedback) ? $sprint->feedback : 'No feedback provided yet.' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

    <script>
        function toggleProjectDetails(projectId) {
            const detailsRow = document.getElementById(`project-details-${projectId}`);
            detailsRow.classList.toggle('hidden');
        }

        function validateSprintsForm(form) {
            const input = form.querySelector('input[name="number_of_sprints"]');
            const errorElement = document.getElementById(`sprints_error_${input.id.split('_').pop()}`);
            const value = parseInt(input.value, 10);

            if (isNaN(value) || value < 1 || value > 10) {
                errorElement.textContent = 'Please enter a number between 1 and 10.';
                errorElement.classList.remove('hidden');
                return false;
            }

            errorElement.classList.add('hidden');
            return true;
        }

        function validateProgressForm(form) {
            const descriptionInput = form.querySelector('textarea[name="description"]');
            const fileInput = form.querySelector('input[type="file"]');
            const descriptionError = document.getElementById(`description_error_${descriptionInput.id.split('_').pop()}`);
            const documentError = document.getElementById(`document_error_${fileInput.id.split('_').pop()}`);
            let isValid = true;

            if (descriptionInput.value.trim().length < 10) {
                descriptionError.textContent = 'Description must be at least 10 characters long.';
                descriptionError.classList.remove('hidden');
                isValid = false;
            } else if (descriptionInput.value.trim().length > 1000) {
                descriptionError.textContent = 'Description must not exceed 1000 characters.';
                descriptionError.classList.remove('hidden');
                isValid = false;
            } else {
                descriptionError.classList.add('hidden');
            }

            if (fileInput.files.length === 0) {
                documentError.textContent = 'Please upload a PDF file.';
                documentError.classList.remove('hidden');
                isValid = false;
            } else {
                const file = fileInput.files[0];
                if (file.type !== 'application/pdf') {
                    documentError.textContent = 'Please upload a PDF file.';
                    documentError.classList.remove('hidden');
                    isValid = false;
                } else if (file.size > 5 * 1024 * 1024) {
                    documentError.textContent = 'File size must not exceed 5MB.';
                    documentError.classList.remove('hidden');
                    isValid = false;
                } else {
                    documentError.classList.add('hidden');
                }
            }

            return isValid;
        }
    </script>
@endsection
