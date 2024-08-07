<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-purple-400 to-purple-600 p-6 text-center">
                <h1 class="text-3xl font-bold text-white">Project Information</h1>
            </div>
            <form action="{{ route('projects.update', $projects) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="project_status" value="pending">

                <div>
                    <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                    <input type="text" name="project_name" id="project_name" value="{{$projects->project_name}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="project_description" class="block text-sm font-medium text-gray-700">Project Description</label>
                    <div class="mt-1">
                        <textarea name="project_description" id="project_description" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>{{ $projects->project_description }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="original_language" class="block text-sm font-medium text-gray-700">Original Language</label>
                    <input type="text" name="original_language" id="original_language"  value="{{$projects->original_language}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="target_language" class="block text-sm font-medium text-gray-700">Target Language</label>
                    <input type="text" name="target_language" id="target_language" value="{{$projects->target_language}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="project_domain" class="block text-sm font-medium text-gray-700">Project Domain</label>
                    <input type="text" name="project_domain" id="project_domain" value="{{$projects->project_domain}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="project_start_date" class="block text-sm font-medium text-gray-700">Project Start Date</label>
                    <input type="date" name="project_start_date" id="project_start_date" value="{{$projects->project_start_date}}"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="project_end_date" class="block text-sm font-medium text-gray-700">Project End Date</label>
                    <input type="date" name="project_end_date" id="project_end_date" value="{{$projects->project_end_date}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="project_budget" class="block text-sm font-medium text-gray-700">Project Budget</label>
                    <input type="number" name="project_budget" id="project_budget" placeholder="Mention in Rupees" value="{{$projects->project_budget}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="editing_proofreading_allowed" value="0">
                    <input type="checkbox" name="editing_proofreading_allowed" id="editing_proofreading_allowed" value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ $projects->editing_proofreading_allowed ? 'checked' : '' }}>
                    <label for="editing_proofreading_allowed" class="ml-2 block text-sm font-medium text-gray-700">Editing/Proofreading Allowed</label>
                </div>

                <div class="flex items-center mt-4">
                    <input type="hidden" name="bidding_allowed" value="0">
                    <input type="checkbox" name="bidding_allowed" id="bidding_allowed" value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ $projects->bidding_allowed ? 'checked' : '' }}>
                    <label for="bidding_allowed" class="ml-2 block text-sm font-medium text-gray-700">Bidding Allowed</label>
                </div>


                <div class="text-center">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-xs font-semibold uppercase tracking-widest rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Update Project
                    </button>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
