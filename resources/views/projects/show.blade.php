<x-app-layout>
    <div class="bg-gradient-to-br from-purple-100 to-purple-200 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600 mb-4">Project Showcase</h1>
                <p class="text-xl text-purple-700">Discover translation projects</p>
            </div>

            <!-- Project Overview Section -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="bg-purple-50 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300 mb-8">
                            <h2 class="text-3xl font-semibold text-purple-800 mb-4">Project Overview</h2>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Project Name:</span>
                                    <span class="text-purple-900">{{ $projects->project_name }}</span>
                                </div>
                                <div class="flex justify-between items-center bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Client:</span>
                                    <span class="text-purple-900">{{ $user->name }}</span>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Description:</span>
                                    <p class="mt-2 text-purple-900">{{ $projects->project_description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-3xl font-semibold text-purple-800 mb-4">Translation Details</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Original Language:</span>
                                    <p class="text-purple-900">{{ $projects->original_language }}</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Target Language:</span>
                                    <p class="text-purple-900">{{ $projects->target_language }}</p>
                                </div>
                                <div class="col-span-2 bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Domain:</span>
                                    <p class="text-purple-900">{{ $projects->project_domain }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div class="bg-purple-50 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-3xl font-semibold text-purple-800 mb-4">Project Details</h2>
                            <div class="space-y-4">
                                <div class="bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Start Date:</span>
                                    <p class="text-purple-900">{{ $projects->project_start_date }}</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">End Date:</span>
                                    <p class="text-purple-900">{{ $projects->project_end_date }}</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Budget:</span>
                                    <p class="text-purple-900">{{ $projects->project_budget }} Rupees</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <span class="text-purple-700 font-medium">Editing/Proofreading:</span>
                                    <p class="text-purple-900">{{ $projects->editing_proofreading_allowed ? 'Allowed' : 'Not Allowed' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-3xl font-semibold text-purple-800 mb-4">Bidding Status</h2>
                            <p class="text-lg font-semibold {{ $projects->bidding_allowed ? 'text-green-600' : 'text-red-600' }}">
                                {{ $projects->bidding_allowed ? 'Open for Bids' : 'Bidding Not Allowed' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('projects.display-projects') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-purple-300 rounded-full text-purple-600 bg-white hover:bg-purple-50 transition duration-300">
                    Back to Projects
                </a>
                <a href="{{ route('clients.display-profile', ['id' => $client->id]) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full text-white bg-purple-600 hover:bg-purple-700 transition duration-300">
                    View Client Profile
                </a>
                <button id="openModalBtn" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300">
                    Apply Now
                </button>
            </div>
        </div>
    </div>

    <!-- Modal container -->
    <div id="applicationModal" class="fixed inset-0 bg-purple-900 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        @if(!$alreadyApplied)
            <div class="relative top-20 mx-auto p-5 border w-full max-w-md sm:max-w-xl md:max-w-2xl shadow-lg rounded-3xl bg-white">
                <div class="absolute top-4 right-4">
                    <button id="closeModalBtn" class="text-purple-400 hover:text-purple-600 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="bg-purple-600 p-6 rounded-t-3xl">
                    <h2 class="text-2xl font-bold text-white text-center">Apply for Project</h2>
                </div>

                <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $projects->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="status" value="Pending">

                    <div>
                        <label for="application_message" class="block text-sm font-medium text-purple-700">Why should we choose you?</label>
                        <textarea id="application_message" name="application_message" rows="4" class="mt-2 block w-full border-purple-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required></textarea>
                    </div>

                    <div>
                        <label for="cv" class="block text-sm font-medium text-purple-700">Upload CV (PDF only)</label>
                        <input type="file" name="cv" accept=".pdf" class="mt-2 block w-full text-sm text-purple-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100" required>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-purple-700">Contact Email</label>
                            <input type="email" id="contact_email" name="contact_email" class="mt-2 block w-full border-purple-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" placeholder="you@example.com" required>
                        </div>
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-purple-700">Contact Phone</label>
                            <input type="tel" id="contact_phone" name="contact_phone" class="mt-2 block w-full border-purple-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" placeholder="+1234567890" required>
                        </div>
                    </div>

                    <div>
                        <label for="language_proficiency" class="block text-sm font-medium text-purple-700">Language Proficiency</label>
                        <select id="language_proficiency" name="language_proficiency" class="mt-2 block w-full border-purple-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                            <option value="">Select proficiency</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Native">Native</option>
                        </select>
                    </div>

                    <div class="text-center mt-8">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white text-base font-semibold rounded-full hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="relative top-20 mx-auto p-5 border w-full max-w-md sm:max-w-xl md:max-w-2xl shadow-lg rounded-3xl bg-white">
                <div class="absolute top-4 right-4">
                    <button id="closeSecondModalBtn" class="text-purple-400 hover:text-purple-600 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="bg-purple-600 p-6 rounded-t-3xl">
                    <h2 class="text-2xl font-bold text-white text-center">Application Status</h2>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-xl font-semibold text-purple-900">You have already applied for this project.</p>
                    <p class="text-purple-700">Please wait for the client to review your application.</p>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('applicationModal');
            const openBtn = document.getElementById('openModalBtn');
            const closeBtn = document.getElementById('closeModalBtn');
            const closeSecondBtn = document.getElementById('closeSecondModalBtn');

            function openModal() {
                if (modal) modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                if (modal) modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            if (openBtn) openBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (closeSecondBtn) closeSecondBtn.addEventListener('click', closeModal);

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });
        });
    </script>
</x-app-layout>
