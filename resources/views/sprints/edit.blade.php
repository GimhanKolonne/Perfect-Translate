@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Edit Phase {{ $sprint->sprint_number }}</h2>

            @if(session('success'))
                <div class="mb-6 p-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-r-md shadow-sm">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 text-red-700 bg-red-100 border-l-4 border-red-500 rounded-r-md shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('sprints.update', $sprint->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('description', $sprint->description) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="progress_document" class="block text-sm font-medium text-gray-700 mb-2">Upload Progress Document</label>
                    <input type="file" name="progress_document" id="progress_document"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                           accept=".pdf">
                    @if($sprint->progress_document)
                        <p class="mt-2 text-sm text-gray-600">Current document: <a href="{{ asset('storage/' . $sprint->progress_document) }}" class="text-blue-600 hover:underline" target="_blank">View</a></p>
                    @endif
                    <p class="mt-2 text-xs text-gray-500">Upload a PDF file (max 5MB)</p>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('projects.management') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel and go back</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Update Phase
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
