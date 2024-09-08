@extends('layouts.client-dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-800">Project Progress</h1>

        @foreach ($project->sprints as $sprint)
            <div class="mt-4 border p-4 rounded shadow">
                <h2 class="font-semibold">Sprint {{ $sprint->sprint_number }}</h2>
                <p><strong>Description:</strong> {{ $sprint->description ?? 'No description provided.' }}</p>
                @if ($sprint->progress_document)
                    <a href="{{ asset('storage/' . $sprint->progress_document) }}" class="text-blue-600 hover:underline">View Document</a>
                @endif

                <h3 class="mt-2 font-semibold">Client Feedback</h3>
                <ul>
                    @foreach ($sprint->feedback as $feedback)
                        <li class="mt-1">
                            <strong>{{ $feedback->client_name }}:</strong> {{ $feedback->message }}
                        </li>
                    @endforeach
                </ul>

                <form action="{{ route('feedback.store', $sprint->id) }}" method="POST" class="mt-2">
                    @csrf
                    <div class="mb-4">
                        <textarea name="message" rows="3" placeholder="Leave your feedback here..." class="border rounded-md w-full px-2 py-1"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Submit Feedback</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
