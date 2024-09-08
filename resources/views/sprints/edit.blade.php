@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-semibold text-gray-700">Edit Phase {{ $sprint->sprint_number }}</h2>

        @if(session('success'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('sprints.update', $sprint->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" id="description" value="{{ $sprint->description }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="progress_document" class="block text-sm font-medium text-gray-700">Upload Progress Document (PDF only)</label>
                <input type="file" name="progress_document" id="progress_document" class="mt-1 block w-full" accept=".pdf">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update Phase</button>
        </form>
    </div>
@endsection
