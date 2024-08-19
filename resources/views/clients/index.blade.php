<x-app-layout>
    <div class="py-12 bg-gradient-to-b from-purple-100 to-purple-200 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 sm:p-10">
                    <h1 class="text-4xl font-extrabold text-purple-900 mb-8 text-center">Our Valued Clients</h1>

                    <div class="mb-10">
                        <form method="get" action="/client/search" class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <input
                                name="search"
                                value="{{ request()->input('search') ? request()->input('search') : '' }}"
                                class="w-full sm:w-96 px-4 py-3 border border-purple-300 rounded-lg text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                placeholder="Search for clients"
                            >
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                                Find Clients
                            </button>
                        </form>
                    </div>

                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @forelse ($clients as $client)
                            <div class="bg-purple-50 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                                <div class="p-6">
                                    <div class="flex flex-col items-center mb-4">
                                        <img src="{{ $client->user->profile_photo_url }}" alt="{{ $client->user->name }}" class="h-24 w-24 rounded-full object-cover border-4 border-purple-400 mb-4">
                                        <h3 class="text-xl font-bold text-purple-900 text-center">{{ $client->contact_name }}</h3>
                                        <p class="text-sm text-purple-600 text-center mt-1">{{ $client->company_name }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 mb-4">
                                        <p class="text-gray-600 text-center">{{ Str::limit($client->bio, 100) }}</p>
                                    </div>
                                    <a href="{{ route('clients.display-profile', $client) }}" class="block w-full text-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
                                        View Full Profile
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-purple-50 rounded-lg shadow-md p-6">
                                <p class="text-purple-700 text-center">No clients found matching your criteria. Please try a different search or check back later!</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-10">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
