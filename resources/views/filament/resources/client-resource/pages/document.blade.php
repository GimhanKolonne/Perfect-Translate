@php
    $documentPaths = json_decode($getState(), true);
@endphp

@if($documentPaths)
    <div class="flex flex-col space-y-2">
        @foreach($documentPaths as $path)
            <a href="{{ asset('storage/' . $path) }}" target="_blank" class="text-blue-600 hover:underline">
                Document {{ $loop->iteration }}
            </a>
        @endforeach
    </div>
@else
    <p class="text-gray-500">No documents uploaded.</p>
@endif
