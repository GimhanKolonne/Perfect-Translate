<div class="py-2">
    @if ($notifications->isEmpty())
        <p class="px-4 text-gray-500">No notifications.</p>
    @else
        <ul class="space-y-2">
            @foreach ($notifications as $notification)
                <li class="px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition">
                    <h3 class="font-semibold text-gray-800">{{ $notification->data['title'] ?? 'No Title' }}</h3>
                    <p class="text-gray-600">{{ $notification->data['body'] ?? 'No Body' }}</p>
                    <p class="text-gray-600">{{ $notification->data['message'] ?? 'No Message' }}</p>
                    <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
