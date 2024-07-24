
@if ($getState())
    <a href="{{ Storage::url($getState()) }}" target="_blank" class="text-blue-500 hover:underline">
        View Certificate
    </a>
@else
    <span class="text-red-500">No Certificate Uploaded</span>
@endif
