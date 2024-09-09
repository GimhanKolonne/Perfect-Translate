@extends('layouts.client-dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Project Progress</h1>

        @if($projects->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">No projects found!</strong>
                <span class="block sm:inline">You currently have no in-progress projects.</span>
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
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
                                    <div class="flex items-center justify-between">
                                        <span>Phase {{ $sprint->sprint_number }}
                                            @if($sprint->progress_document)
                                                <span class="text-green-500 ml-2">✔️</span>
                                            @else
                                                <span class="text-red-500 ml-2">✖️</span>
                                            @endif
                                        </span>
                                        <a href="{{ route('client.sprints.progress', $sprint->id) }}" class="text-blue-600 hover:underline">View Progress</a>

                                    </div>

                                @endforeach
                            </td>
                            <td class="py-3 px-4 border-b text-sm text-gray-800">
                                <a href="{{ route('chat.index', $project->id) }}" class="bg-green-600 text-white px-4 py-1 rounded-md hover:bg-green-700">Chat</a> <!-- Chat Button -->

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection
