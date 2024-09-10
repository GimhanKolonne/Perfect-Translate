@extends('layouts.client-dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8 bg-gray-50">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Project Progress</h1>

        @if($projects->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg shadow" role="alert">
                <strong class="font-bold">No projects found!</strong>
                <span class="block sm:inline">You currently have no in-progress projects.</span>
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-600">Project Name</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-600">Translator</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-600">Phases</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($projects as $project)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-4 border-b text-sm text-gray-800">{{ $project->project_name }}</td>
                            <td class="py-3 px-4 border-b text-sm text-gray-800">
                                @php
                                    $translator = $project->applications->where('status', 'Accepted')->first()->user ?? null;
                                @endphp
                                {{ $translator ? $translator->name : 'N/A' }}
                            </td>
                            <td class="py-3 px-4 border-b text-sm text-gray-800">
                                @foreach ($project->sprints as $sprint)
                                    <div class="flex items-center justify-between mb-2">
                                    <span>Phase {{ $sprint->sprint_number }}
                                        @if($sprint->progress_document)
                                            <span class="text-green-500 ml-2">✔️</span>
                                        @else
                                            <span class="text-red-500 ml-2">✖️</span>
                                        @endif
                                    </span>
                                        <button onclick="toggleProgress({{ $sprint->id }})" class="text-blue-600 hover:underline">View Progress</button>
                                    </div>
                                @endforeach
                            </td>
                            <td class="py-3 px-4 border-b text-sm text-gray-800">
                                <a href="{{ route('chat.index', $project->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-300 ease-in-out">Chat</a>
                            </td>
                        </tr>
                        @foreach ($project->sprints as $sprint)
                            <tr id="progress-{{ $sprint->id }}" class="hidden bg-gray-50">
                                <td colspan="4" class="px-6 py-4">
                                    <div class="space-y-4">
                                        <div class="bg-white p-4 rounded-md shadow-sm border border-gray-200">
                                            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                                                Progress for {{ $project->project_name }} - Phase {{ $sprint->sprint_number }}
                                            </h2>

                                            <div class="mb-4">
                                                <strong class="text-gray-700">Description:</strong>
                                                <p class="mt-1 text-gray-600">{{ $sprint->description ?: 'No description available.' }}</p>
                                            </div>

                                            @if ($sprint->progress_document)
                                                <div class="mb-4">
                                                    <strong class="text-gray-700">Progress Document:</strong>
                                                    <a href="{{ asset('storage/' . $sprint->progress_document) }}" class="ml-2 text-blue-600 hover:underline">
                                                        <i class="fas fa-file-download"></i> View Document
                                                    </a>
                                                </div>
                                            @else
                                                <p class="mb-4 text-yellow-600">No progress document available for this phase.</p>
                                            @endif

                                            <div class="mt-6">
                                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Feedback</h3>

                                                @if (session('success'))
                                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md mb-4" role="alert">
                                                        <strong class="font-bold">{{ session('success') }}</strong>
                                                    </div>
                                                @endif

                                                <form id="feedbackForm-{{ $sprint->id }}" action="{{ route('client.sprints.feedback', $sprint->id) }}" method="POST" class="mt-4">
                                                    @csrf
                                                    <textarea name="feedback" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your feedback here...">{{ old('feedback', $sprint->feedback) }}</textarea>
                                                    @error('feedback')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                    <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">
                                                        <i class="fas fa-paper-plane"></i> Submit Feedback
                                                    </button>
                                                </form>

                                                <div class="mt-3 pt-3 border-t border-gray-200">
                                                    <h5 class="text-sm font-medium text-gray-900">Previous Feedback:</h5>
                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ !empty($sprint->feedback) ? $sprint->feedback : 'No feedback provided yet.' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

    <script>
        function toggleProgress(sprintId) {
            const progressRow = document.getElementById(`progress-${sprintId}`);
            progressRow.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const successMessages = document.querySelectorAll('.bg-green-100');
            successMessages.forEach(message => {
                setTimeout(() => {
                    message.style.display = 'none';
                }, 5000); // Hides the message after 5 seconds
            });
        });
    </script>
@endsection
