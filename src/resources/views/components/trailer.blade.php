@php
  $key = $items->videos->trailerKey();
@endphp

<div class="relative aspect-6/5 sm:aspect-4/3 md:aspect-5/3 flex items-center justify-flex-start flex-col relative min-w-full lg:min-w-3xl lg:max-w-[70%] overflow-hidden">
    
    <input type="checkbox" id="toggle-trailer-{{ $key }}" class="hidden peer"/>
    
    <div class="peer-checked:hidden flex relative justify-center bg-black rounded-md flex-col items-center w-full aspect-video overflow-hidden">
        <img class="min-w-[110%] rounded-md"
             src="{{ $items->videos->snapMaxRes() }}"
             alt="Trailer preview">
        <div class="absolute w-full h-full bg-linear-to-t from-black to-transparent to-20%"></div>
    </div>

    <iframe src="https://www.youtube.com/embed/{{ $key }}?autoplay=1&controls=0&rel=0&modestbranding=1"
            title="YouTube trailer"
            loading="lazy"
            allow="autoplay; encrypted-media"
            allowfullscreen
            referrerpolicy="strict-origin-when-cross-origin"
            class="hidden peer-checked:block absolute inset-0 w-full h-full border-0 rounded-md">
    </iframe>
    
    <div class="absolute bottom-0 flex flex-row w-full p-3 md:p-4">
        <div class="w-32 sm:w-40 md:w-48 lg:w-56 shadow-1 flex flex-col justify-center">
            <img class="rounded-lg" 
            src="{{ $items->imagePreview()}}" 
            alt="Movie Poster">
        </div>
        <div class="w-full flex flex-col md:flex-row justify-end md:justify-start px-3 py-2 gap-1">
            <div class="flex items-center gap-3 md:flex-col md:justify-end sm:p-2 pr-3 md:pb-4">
                <label for="toggle-trailer-{{ $key }}"
                       class="size-10 sm:size-14 md:size-16 border-3 border-white rounded-full 
                              flex justify-center items-center cursor-pointer
                              peer-checked:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#ffffff" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-icon lucide-play"><polygon points="6 3 20 12 6 21 6 3"/></svg>
                </label>
                <span class="text-white font-normal text-sm md:hidden">0</span>
            </div>
            <div class="flex flex-col justify-end">
                <a href="{{ $items->route() }}" class="text-white font-bold text-lg sm:text-xl md:text-3xl hover:text-green-400 hover:underline decoration-rose-500">{{ $items->title }}</a>
                <span class="text-yellow-400 brightness-400 text-sm sm:text-lg md:text-xl">Watch the trailer</span>
                <div class="flex flex-row gap-3 py-1">
                    <div class="flex flex-row text-white text-xs gap-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thumbs-up-icon lucide-thumbs-up"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                        <p>0</p>
                    </div>
                    <div class="flex flex-row text-white text-xs gap-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#ef4444" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        <p>0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="absolute left-0 top-[40%] -translate-x-3 sm:-translate-x-4 brightness-400" method="GET">
    @csrf
    <button class="text-white w-8 sm:w-10 h-20 border-1 border-l-0 border-yellow-400 bg-black/70 bg-opacity-50 rounded-r-md flex justify-center items-center cursor-pointer overflow-hidden" name="trailer_direction" value="backward">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#facc15" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="translate-x-1 lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>    
    </button>
    </form>
    <form class="absolute right-0 top-[40%] translate-x-3 sm:translate-x-4 brightness-400" method="GET">
    @csrf
    <button class="text-white w-8 sm:w-10 h-20 border-1 border-r-0 border-yellow-400 bg-black/70 bg-opacity-50 rounded-l-md flex justify-center items-center cursor-pointer" name="trailer_direction" value="forward">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#facc15" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="-translate-x-1 lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
    </button>
</form>
</div>