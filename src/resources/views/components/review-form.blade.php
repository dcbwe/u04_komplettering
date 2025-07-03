@props(['mediaId', 'mediaType', 'initialContent' => ''])
<div class="relative flex flex-col justify-between h-34 w-1/2 md:w-1/3 xl:w-1/4 flex-shrink-0 bg-zinc-800 p-1 rounded-md border-1 {{ colorShadow() }}">
<form action="{{ route('review.store') }}" method="POST" class="flex flex-col justify-between h-full">
    @csrf
    <input type="hidden" name="media_id" value="{{ $mediaId }}">
    <input type="hidden" name="media_type" value="{{ $mediaType }}">

    <textarea class="font-bold text-sm sn:text-base p-2 text-white border-none caret-none outline-none w-full bg-zinc-800 line-clamp-5 h-full resize-none" 
              name="content" 
              id="review" 
              required
              minlength="5" 
              maxlength="3000"
              placeholder="Write a review...">{{ $initialContent }}</textarea>

    <button type="submit"
            class="text-xs sm:text-sm text-yellow-400 text-right brightness-400 hover:underline decoration-green-400 px-1">
            {{ $initialContent ? 'Update Review' : 'Post Review' }}
    </button>
</form>
</div>
