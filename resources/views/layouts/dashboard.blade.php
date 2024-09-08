<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 transition duration-300 transform bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700  overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="text-white text-2xl mx-2 font-semibold">Welcome</span>
                </div>
            </div>

            <nav class="mt-10">


                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-purple-600 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('projects.display-projects') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                    </svg>

                    <span class="mx-3">All Projects</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-purple-600 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('projects.sent-applications') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>

                    <span class="mx-3">My Applications</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-purple-600 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('projects.accepted-applications') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span class="mx-3">Accepted Projects</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-purple-600 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('projects.completed-applications') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>

                    <span class="mx-3">Completed Projects</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-purple-600 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('projects.management') }}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>

                    <span class="mx-3">Project Management</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">


            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
