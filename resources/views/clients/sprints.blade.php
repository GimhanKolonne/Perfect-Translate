@extends('layouts.client-dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Phase Progress for {{ $sprint->project->project_name }} - Phase {{ $sprint->sprint_number }}</h1>

        <div class="mt-4">
            <strong>Description:</strong>
            <p>{{ $sprint->description }}</p>
        </div>

        @if ($sprint->progress_document)
            <div class="mt-4">
                <strong>Progress Document:</strong>
                <a href="{{ asset('storage/' . $sprint->progress_document) }}" class="text-blue-600 hover:underline">View Document</a>
            </div>
        @else
            <p>No progress document available for this phase.</p>
        @endif

        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Feedback</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ session('success') }}</strong>
                </div>
            @endif

            <form id="feedbackForm" action="{{ route('client.sprints.feedback', $sprint->id) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="feedback" rows="4" class="border rounded-md w-full px-2 py-1" placeholder="Enter your feedback here...">{{ old('feedback', $sprint->feedback) }}</textarea>
                @error('feedback')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-md">Submit Feedback</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.bg-green-100');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000); // Hides the message after 5 seconds
            }
        });
    </script>
@endsection
