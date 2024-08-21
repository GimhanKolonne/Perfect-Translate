<x-app-layout>
    <div class="bg-gray-200 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg w-full bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800">Update Project</h1>
            </div>
            <form action="{{ route('projects.update', $projects) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="project_status" value="Pending">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="project_name" class="block text-sm font-semibold text-gray-700">Project Name</label>
                        <input type="text" name="project_name" id="project_name" value="{{ $projects->project_name }}" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm" placeholder="Enter project name">
                    </div>

                    <div>
                        <label for="project_domain" class="block text-sm font-semibold text-gray-700">Project Domain</label>
                        <input type="text" name="project_domain" id="project_domain" value="{{ $projects->project_domain }}" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm" placeholder="Enter project domain">
                    </div>

                    <div>
                        <label for="original_language" class="block text-sm font-semibold text-gray-700">Original Language</label>
                        <input type="text" name="original_language" id="original_language" value="{{ $projects->original_language }}" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm" placeholder="Enter original language">
                    </div>

                    <div>
                        <label for="target_language" class="block text-sm font-semibold text-gray-700">Target Language</label>
                        <input type="text" name="target_language" id="target_language" value="{{ $projects->target_language }}" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm" placeholder="Enter target language">
                    </div>

                    <div>
                        <label for="project_start_date" class="block text-sm font-semibold text-gray-700">Start Date</label>
                        <input type="date" name="project_start_date" id="project_start_date" value="{{ $projects->project_start_date }}" required min="{{ now()->format('Y-m-d') }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="project_end_date" class="block text-sm font-semibold text-gray-700">End Date</label>
                        <input type="date" name="project_end_date" id="project_end_date" value="{{ $projects->project_end_date }}" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="project_budget" class="block text-sm font-semibold text-gray-700">Project Budget (in Rupees)</label>
                        <input type="number" name="project_budget" id="project_budget" value="{{ $projects->project_budget }}" required min="1" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm" placeholder="Enter amount in Rupees">
                    </div>

                    <div>
                        <label for="project_description" class="block text-sm font-semibold text-gray-700">Project Description</label>
                        <textarea name="project_description" id="project_description" rows="4" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 sm:text-sm" placeholder="Provide a detailed description">{{ $projects->project_description }}</textarea>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="flex items-center">
                        <input type="hidden" name="editing_proofreading_allowed" value="0">
                        <input type="checkbox" name="editing_proofreading_allowed" id="editing_proofreading_allowed" value="1" {{ $projects->editing_proofreading_allowed ? 'checked' : '' }} class="h-5 w-5 text-purple-600 border-gray-300 rounded focus:ring-2 focus:ring-purple-500">
                        <label for="editing_proofreading_allowed" class="ml-2 block text-sm font-medium text-gray-700">Editing/Proofreading Allowed</label>
                    </div>

                    <div class="flex items-center">
                        <input type="hidden" name="bidding_allowed" value="0">
                        <input type="checkbox" name="bidding_allowed" id="bidding_allowed" value="1" {{ $projects->bidding_allowed ? 'checked' : '' }} class="h-5 w-5 text-purple-600 border-gray-300 rounded focus:ring-2 focus:ring-purple-500">
                        <label for="bidding_allowed" class="ml-2 block text-sm font-medium text-gray-700">Bidding Allowed</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out">
                        Update Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
