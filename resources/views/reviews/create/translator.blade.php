<x-app-layout>
    <div class="py-12 bg-gradient-to-r from-purple-200 via-purple-300 to-purple-400 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Review Client</h2>

                    <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="hidden" name="reviewer_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="reviewee_id" value="{{ $project->user_id }}">

                        <div class="mb-6">
                            <label for="rating" class="block text-gray-700 font-bold mb-2">Rating:</label>
                            <select id="rating" name="rating" class="w-full border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="review" class="block text-gray-700 font-bold mb-2">Review:</label>
                            <textarea id="review" name="review" rows="4" class="w-full border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm" required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-800 focus:outline-none focus:border-purple-800 focus:ring focus:ring-purple-300 disabled:opacity-25 transition duration-150 ease-in-out">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
