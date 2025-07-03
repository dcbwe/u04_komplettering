<div class="hidden lg:flex flex-col w-fit">

    <div class="flex flex-row w-full px-3 py-1">
        <div class="min-w-22 max-w-22 shadow-1 rounded-md border-1 {{ colorShadow() }} overflow-hidden">
            <img
            src="{{ $items->imagePreview() }}" 
            alt="Movie Poster">
        </div>
        <div class="w-full flex flex-col justify-center px-3 py-1 gap-1">
            <div class="flex items-center gap-3 flex-row justify-start p-1">
                <a href="https://youtube.com/video/{{ $items->videos->trailerKey() }}" target="_blank">
                    <div class="size-9 border-2 border-white rounded-full flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#ffffff" stroke="transparent" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-icon lucide-play"><polygon points="6 3 20 12 6 21 6 3"/></svg>
                    </div>
                </a>
                <span class="text-white font-normal text-sm">0:00</span>
            </div>
            <div class="flex flex-col justify-center">
                <a href="{{ $items->route() }}" class="text-white font-bold text-base hover:text-green-400 hover:underline decoration-rose-500">{{ $items->title }}</a>
                <span class="text-yellow-400 text-sm brightness-400">Watch the trailer</span>
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
</div>