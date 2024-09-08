@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Project Management</h1>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 text-red-700 bg-red-100 rounded shadow">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
            <tr class="bg-gray-200">
                <th class="py-3 px-4 border-b text-left">Project Name</th>
                <th class="py-3 px-4 border-b text-left">Status</th>
                <th class="py-3 px-4 border-b text-left">Phases</th>
                <th class="py-3 px-4 border-b text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
                <tr class="hover:bg-gray-100 transition">
                    <td class="py-3 px-4 border-b">{{ $project->project_name }}</td>
                    <td class="py-3 px-4 border-b">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                            {{ $project->project_status === 'Completed' ? 'bg-green-200 text-green-600' :
                               ($project->project_status === 'In Progress' ? 'bg-yellow-200 text-yellow-600' :
                               'bg-red-200 text-red-600') }}">
                            {{ ucfirst($project->project_status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4 border-b">
                        @if ($project->sprints()->count() === 0)
                            <form action="{{ route('projects.setSprints', $project->id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="number" name="number_of_sprints" placeholder="Number of sprints"
                                       class="border border-gray-300 rounded-md px-2 py-1 w-1/2" required min="1">
                                <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-1 rounded-md">Set Phases</button>
                            </form>
                        @else
                            <div class="space-y-4">
                                @foreach ($project->sprints as $sprint)
                                    <div class="border p-4 rounded-md shadow-sm">
                                        <strong class="text-lg">Phase {{ $sprint->sprint_number }}</strong>
                                        @if (empty($sprint->description))
                                            <form action="{{ route('sprints.updateProgress', $sprint->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                                @csrf
                                                <input type="text" name="description" placeholder="Progress description"
                                                       class="border border-gray-300 rounded-md px-2 py-1 w-full" required>
                                                <input type="file" name="progress_document" class="ml-2 mt-2" accept=".pdf">
                                                <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-1 rounded-md">Submit</button>
                                            </form>
                                        @else
                                            <p class="mt-1">{{ $sprint->description }}</p>
                                            @if ($sprint->progress_document)
                                                <a href="{{ asset('storage/' . $sprint->progress_document) }}" class="text-blue-600 hover:underline">View Document</a>
                                            @endif
                                            <div class="mt-1">
                                                <a href="{{ route('sprints.edit', $sprint->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                            </div>
                                        @endif

                                        <!-- Display Feedback -->
                                        <div class="mt-2">
                                            <strong>Feedback:</strong>
                                            @if (!empty($sprint->feedback))
                                            <p>{{ $sprint->feedback }}</p>
                                            @else
                                                <p>No feedback provided yet.</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td class="py-3 px-4 border-b">
                        <a href="{{ route('projects.show', $project->id) }}" class="text-blue-600 hover:underline">View Details</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if ($projects->isEmpty())
            <div class="mt-4 text-center text-gray-500">No accepted projects found.</div>
        @endif

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>
@endsection
