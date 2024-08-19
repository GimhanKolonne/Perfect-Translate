    @php
    $certificatePaths = json_decode($getState(), true);
@endphp

@if($certificatePaths)
    <div class="flex flex-col space-y-2">
        @foreach($certificatePaths as $path)
            <a href="{{ asset('storage/' . $path) }}" target="_blank" class="text-blue-600 hover:underline">
                Certificate {{ $loop->iteration }}
            </a>
        @endforeach
    </div>
@else
    <p class="text-gray-500">No certificates uploaded.</p>
@endif
