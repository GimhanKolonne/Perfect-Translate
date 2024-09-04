
<div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Reviews') }}</h3>
        @if($reviews->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($reviews as $review)
                    <li class="py-4">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full" src="{{ $review->reviewer->profile_photo_url }}" alt="{{ $review->reviewer->name }}">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $review->reviewer->name }}</p>
                                <p class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-gray-700">{{ $review->review }}</p>
                            <div class="mt-2 flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.88 8.719c-.784-.57-.381-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                        </svg>
                                    @else
                                        <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.88 8.719c-.784-.57-.381-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">{{ __('No reviews yet.') }}</p>
        @endif
    </div>
</div>
