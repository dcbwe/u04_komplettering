<div class="space-y-6">
    @foreach($reviews->reviews as $review)
        <div class="p-4 border rounded-md bg-white shadow-sm">
            <div class="flex items-center mb-2">
                <div>
                    <div class="font-semibold">{{ $review->userName }}</div>
                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($review->createdAt)->diffForHumans() }}</div>
                </div>
            </div>
            <p class="text-sm text-gray-800 whitespace-pre-wrap">{{ $review->content }}</p>
        </div>
    @endforeach

    @if(count($reviews->reviews) === 4)
        <div class="text-center">
            <button class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded">
                Show More Reviews
            </button>
        </div>
    @endif
</div>
