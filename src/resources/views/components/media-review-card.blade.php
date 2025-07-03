@props([
    'review',
    'editable' => false,
    'editing' => false,
    'showControls' => true,
    'initialContent' => '',
])

<div class="relative flex flex-col justify-between h-34 w-1/2 md:w-1/3 xl:w-1/4 flex-shrink-0 bg-zinc-800 p-1 rounded-md snap-start border-1 {{ colorShadow() }}">
    {{-- Top row --}}
    <div class="flex items-end justify-between p-1 mb-1">
    <div class="flex items-end gap-1">
        <div class="text-sm sm:text-base text-green-400 font-bold leading-none">
            {{ $review->userName }}
        </div>
        <div class="text-[0.5rem] sm:text-xs font-light text-indigo-400 leading-none">
            {{ \Carbon\Carbon::parse($review->createdAt)->diffForHumans() }}
        </div>
    </div>

    <div class="text-sm sm:text-base text-blue-500 brightness-200 font-bold leading-none">
        {{ $review->getUserRating() }}
    </div>
</div>


    {{-- Content display or edit --}}
    @if ($editing)
        <form method="POST" action="{{ route('review.store') }}" class="flex flex-col h-20 justify-between">
            @csrf
            <input type="hidden" name="media_id" value="{{ $review->id }}">
            <input type="hidden" name="media_type" value="{{ request()->route('media_type', 'movie') }}">

            <textarea name="content"
                      required
                      minlength="5"
                      maxlength="3000"
                      class="h-full text-xs sm:text-sm text-white bg-zinc-700 p-1 rounded-md shadow resize-none overflow-y-auto"
            >{{ old('content', $initialContent) }}</textarea>

        </form>
    @else
        <div class="text-sm text-white line-clamp-3 rounded bg-zinc-800 p-1">{{ $review->content }}
        </div>
    @endif

    {{-- Bottom row --}}
@if ($showControls)
    <div class="flex flex-row-reverse justify-between items-end gap-2 p-1 mt-1">
        @if ($editable)
            @if ($editing)
            <form method="POST" action="{{ route('review.cancel-edit') }}">
                @csrf
                <button type="submit" class="text-xs sm:text-sm text-yellow-400 brightness-400 hover:underline decoration-green-400 px-1">Cancel</button>
            </form>

            <button form="review-form-{{ $review->id }}"
                    type="submit"
                    class="text-sm text-yellow-400 brightness-400 hover:underline decoration-green-400 px-1">
                Save
            </button>
            @else
            <form method="POST" action="{{ route('review.edit-mode') }}">
                @csrf
                <button type="submit" class="text-xs sm:text-sm text-yellow-400 brightness-400 hover:underline decoration-green-400 px-1">Edit Review</button>
            </form>
            @endif
        @else
            <button type="button" class="text-xs sm:text-sm text-yellow-400 brightness-400 hover:underline decoration-green-400 px-1">Read More</button>
        @endif
    </div>
@endif

</div>
