@extends('layouts.client-dashboard')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Project Progress</h1>

        @if($projects->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow" role="alert">
                <p class="font-bold">No projects found</p>
                <p>You currently have no in-progress projects.</p>
            </div>
        @else
            @error('feedback')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            <div class="overflow-x-auto bg-white shadow-xl rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Translator</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phases</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($projects as $project)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $project->project_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @php
                                    $translator = $project->applications->where('status', 'Accepted')->first()->user ?? null;
                                @endphp
                                {{ $translator ? $translator->name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @foreach ($project->sprints as $sprint)
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="flex items-center">
                                            Phase {{ $sprint->sprint_number }}
                                            @if($sprint->progress_document)
                                                <svg class="ml-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @else
                                                <svg class="ml-2 h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </span>
                                        <button onclick="toggleProgress({{ $sprint->id }})" class="text-blue-600 hover:text-blue-800 focus:outline-none focus:underline">
                                            View Progress
                                        </button>
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('chat.index', $project->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Chat
                                </a>

                                @if($project->sprints->isNotEmpty() && $project->sprints->every(fn($sprint) => $sprint->progress_document))
                                    <form action="{{ route('client.projects.complete', $project->id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Mark as Completed
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @foreach ($project->sprints as $sprint)
                            <tr id="progress-{{ $sprint->id }}" class="hidden bg-gray-50">
                                <td colspan="4" class="px-6 py-4">
                                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                                            Progress for {{ $project->project_name }} - Phase {{ $sprint->sprint_number }}
                                        </h2>

                                        <div class="mb-4">
                                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Description:</h3>
                                            <p class="text-gray-600">{{ $sprint->description ?: 'No description available.' }}</p>
                                        </div>

                                        @if ($sprint->progress_document)
                                            <div class="mb-4">
                                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Progress Document:</h3>
                                                <a href="{{ asset('storage/' . $sprint->progress_document) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                    View Document
                                                </a>
                                            </div>
                                        @else
                                            <p class="mb-4 text-yellow-600">No progress document available for this phase.</p>
                                        @endif

                                        <div class="mt-6">
                                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Feedback</h3>

                                            <form id="feedbackForm-{{ $sprint->id }}" action="{{ route('client.sprints.feedback', $sprint->id) }}" method="POST" class="mt-4">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">Your Feedback</label>
                                                    <textarea id="feedback" name="feedback" rows="4" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Enter your feedback here...">{{ old('feedback', $sprint->feedback) }}</textarea>
                                                </div>
                                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                                    Submit Feedback
                                                </button>
                                            </form>

                                            @if(!empty($sprint->feedback))
                                                <div class="mt-6 pt-6 border-t border-gray-200">
                                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Previous Feedback:</h4>
                                                    <p class="text-gray-600">{{ $sprint->feedback }}</p>
                                                </div>
                                            @endif
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
            const successMessages = document.querySelectorAll('[role="alert"]');
            successMessages.forEach(message => {
                setTimeout(() => {
                    message.style.transition = 'opacity 1s ease-out';
                    message.style.opacity = 0;
                    setTimeout(() => message.remove(), 1000);
                }, 5000);
            });
        });
    </script>
@endsection
