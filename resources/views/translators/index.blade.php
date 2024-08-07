<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-gradient-to-r from-purple-500 to-purple-700 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl text-white font-bold">Our Translators</h2>
                        <form method="get" action="/translator/search">
                            <input name="search" value="{{request()->input('search') ? request()->input('search'): ''}}" class="form-control ml-auto bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 mr-3.5" placeholder="Search For Translators">
                            <button type="submit"  class="inline-flex items-center px-4 py-2 bg-white text-purple-700 border border-transparent rounded-full font-semibold text-sm uppercase tracking-widest hover:bg-purple-100 transition duration-300">
                                Search
                            </button>
                        </form>

                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-white">
                    @forelse ($translators as $translator)
                        <div class="bg-purple-100 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                            <div class="p-6">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ $translator->user->profile_photo_url }}" alt="{{ $translator->user->name }}" class="rounded-full h-32 w-32 object-cover border-4 border-purple-200 shadow-md">
                                </div>
                                <div class="text-center mb-4">
                                    <h3 class="text-2xl font-semibold text-purple-800">{{ $translator->user->name }}</h3>
                                </div>
                                <div class="flex justify-center mb-4">
                                    <p class="text-sm font-medium text-purple-600">
                                        @if(is_array($translator->language_pairs))
                                            {{ implode(' • ', $translator->language_pairs) }}
                                        @endif


                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 text-center">{{ Str::limit($translator->bio, 100) }}</p>
                                <div class="flex justify-center mt-4">
                                    <a href="{{ route('translators.display-profile', $translator) }}" class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full hover:bg-purple-700 transition duration-300">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow-md p-6 col-span-full">
                            <p class="text-gray-700 text-center">No translators found. Please check back later!</p>
                        </div>
                    @endforelse
                </div>

                <div class="px-6 py-4">
                    {{ $translators->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
