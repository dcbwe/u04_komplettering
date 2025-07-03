<div class="flex flex-col shrink-0 w-34 sm:w-42 lg:min-w-50 rounded-md overflow-hidden pb-1 relative min-h-auto">
    
    <img src="{{ $item->imagePreview() }}"
         alt="{{ $item->title }}"
         class="mb-2 rounded-full shadow h-auto size-34 sm:size-42 lg:size-50">

    <p class="text-yellow-400 brightness-200 font-semibold text-center text-sm sm:text-base">
        {{ $rank }}
    </p>

    <a href="{{ $item->route() }}" 
       class="text-white text-sm sm:text-base hover:text-green-400 hover:underline decoration-rose-500 font-semibold 
              whitespace-nowrap truncate text-center p-1 mb-2">
        {{ $item->title }}
    </a>

</div>

