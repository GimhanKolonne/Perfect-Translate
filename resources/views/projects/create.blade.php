@extends('layouts.client-dashboard')

@section('content')
    <div class="bg-white min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-purple-600 text-white py-4 px-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold">Create New Project</h1>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center text-white hover:text-purple-200 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back to Projects
                    </a>
                </div>
            </div>

            <form action="{{ route('projects.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="project_status" value="Pending">

                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-1">
                        <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                        <input type="text" name="project_name" id="project_name" value="{{ old('project_name') }}" required class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('project_name') border-red-300 text-red-900 placeholder-red-300 @enderror" placeholder="Enter project name">
                        @error('project_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="project_domain" class="block text-sm font-medium text-gray-700">Project Domain</label>
                        <input type="text" name="project_domain" id="project_domain" value="{{ old('project_domain') }}" required class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('project_domain') border-red-300 text-red-900 placeholder-red-300 @enderror" placeholder="Enter project domain">
                        @error('project_domain')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="original_language" class="block text-sm font-medium text-gray-700">Original Language</label>
                        <select name="original_language" id="original_language" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm @error('original_language') border-red-300 text-red-900 @enderror">
                            <option value="" disabled {{ old('original_language') ? '' : 'selected' }}>Select original language</option>
                            @foreach(['Sinhala', 'Tamil', 'English'] as $language)
                                <option value="{{ $language }}" {{ old('original_language') == $language ? 'selected' : '' }}>{{ $language }}</option>
                            @endforeach
                        </select>
                        @error('original_language')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="target_language" class="block text-sm font-medium text-gray-700">Target Language</label>
                        <select name="target_language" id="target_language" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm @error('target_language') border-red-300 text-red-900 @enderror">
                            <option value="" disabled {{ old('target_language') ? '' : 'selected' }}>Select target language</option>
                            @foreach(['Sinhala', 'Tamil', 'English'] as $language)
                                <option value="{{ $language }}" {{ old('target_language') == $language ? 'selected' : '' }}>{{ $language }}</option>
                            @endforeach
                        </select>
                        @error('target_language')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="project_start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="project_start_date" id="project_start_date" value="{{ old('project_start_date') }}" required min="{{ now()->format('Y-m-d') }}" class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('project_start_date') border-red-300 text-red-900 @enderror">
                        @error('project_start_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="project_end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="project_end_date" id="project_end_date" value="{{ old('project_end_date') }}" required class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('project_end_date') border-red-300 text-red-900 @enderror">
                        @error('project_end_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label for="project_budget" class="block text-sm font-medium text-gray-700">Project Budget (in Rupees)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            </div>
                            <input type="number" name="project_budget" id="project_budget" value="{{ old('project_budget') }}" required min="1" max="10000000" class="focus:ring-purple-500 focus:border-purple-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md @error('project_budget') border-red-300 text-red-900 placeholder-red-300 @enderror" placeholder="0.00">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">LKR</span>
                            </div>
                        </div>
                        @error('project_budget')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="project_description" class="block text-sm font-medium text-gray-700">Project Description</label>
                    <textarea name="project_description" id="project_description" rows="4" required class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('project_description') border-red-300 text-red-900 placeholder-red-300 @enderror" placeholder="Provide a detailed description">{{ old('project_description') }}</textarea>
                    @error('project_description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="editing_proofreading_allowed" id="editing_proofreading_allowed" value="1" {{ old('editing_proofreading_allowed') ? 'checked' : '' }} class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="editing_proofreading_allowed" class="font-medium text-gray-700">Editing/Proofreading Allowed</label>
                            <p class="text-gray-500">Allow editors to make changes to the translated content.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="bidding_allowed" id="bidding_allowed" value="1" {{ old('bidding_allowed') ? 'checked' : '' }} class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="bidding_allowed" class="font-medium text-gray-700">Bidding Allowed</label>
                            <p class="text-gray-500">Allow translators to bid on your project.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <a href="{{ route('projects.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Cancel
                        </a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Post Job
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const startDateInput = document.getElementById('project_start_date');
                const endDateInput = document.getElementById('project_end_date');
                const originalLanguageSelect = document.getElementById('original_language');
                const targetLanguageSelect = document.getElementById('target_language');

                startDateInput.addEventListener('change', function() {
                    endDateInput.min = this.value;
                });

                endDateInput.addEventListener('change', function() {
                    if (this.value < startDateInput.value) {
                        alert('End date cannot be earlier than start date');
                        this.value = '';
                    }
                });

                originalLanguageSelect.addEventListener('change', function() {
                    updateTargetLanguageOptions();
                });

                function updateTargetLanguageOptions() {
                    const originalLanguage = originalLanguageSelect.value;
                    const targetOptions = targetLanguageSelect.options;

                    for (let i = 0; i < targetOptions.length; i++) {
                        if (targetOptions[i].value === originalLanguage) {
                            targetOptions[i].disabled = true;
                            targetOptions[i].style.display = 'none';
                        } else {
                            targetOptions[i].disabled = false;
                            targetOptions[i].style.display = '';
                        }
                    }

                    if (targetLanguageSelect.value === originalLanguage) {
                        targetLanguageSelect.value = '';
                    }
                }

                updateTargetLanguageOptions();
            });
        </script>
    @endpush
@endsection
