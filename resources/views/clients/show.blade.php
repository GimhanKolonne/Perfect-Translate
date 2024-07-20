<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                <h1 class="text-3xl font-bold text-white text-center">Client Profile</h1>
            </div>

            <!-- Profile Photo and Name Section -->
            <div class="bg-white p-6 flex items-center justify-center flex-col">
                <div class="w-20 h-20 rounded-full overflow-hidden">
                    <img src="{{ $client->user->profile_photo_url }}" alt="{{ $client->user->name }}" class="w-full h-full object-cover">
                </div>
                <h2 class="mt-4 text-2xl font-semibold text-gray-800">{{ $client->user->name }}</h2>
            </div>

            <div class="p-6 sm:p-8">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Company Details Section -->
                    <div>
                        <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">Company Details</h2>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Company Name</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->company_name }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Contact Name</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->contact_name }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Contact Phone</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->contact_phone }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Company Address</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->company_address }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Country</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->country }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Website</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->website }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Industry</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->industry }}</p>
                        </div>
                    </div>

                    <!-- About You Section -->
                    <div>
                        <h2 class="text-xl font-semibold mb-3 text-gray-800 pb-4">About You</h2>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1 pb-4">Bio</label>
                            <p class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 py-2 px-3">{{ $client->bio }}</p>
                        </div>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('clients.edit', $client) }}" class="px-4 py-2 bg-blue-500 text-black font-medium rounded-md border-2 border-blue-700 shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
