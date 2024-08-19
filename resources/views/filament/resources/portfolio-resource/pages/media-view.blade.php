@if($getState() && is_array($getState()))
    <div class="flex flex-col space-y-2">
        @foreach($getState() as $path)
            <a href="{{ asset('storage/' . $path) }}" target="_blank" class="text-blue-600 hover:underline">
                Media {{ $loop->iteration }}
            </a>
        @endforeach
    </div>
@else
    <p class="text-gray-500">No media files uploaded.</p>
@endif
