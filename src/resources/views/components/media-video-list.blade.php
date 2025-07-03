<section class="w-full max-w-7xl py-6 bg-zinc-900 rounded-md">
    <x-title title="Videos" subtitle="Watch trailers and clips"/>

    <div class="flex flex-wrap justify-between overflow-hidden">

        <div class="flex basis-full md:basis-1/3 flex-1 justify-center p-2">
            <div class="relative w-full aspect-video overflow-hidden rounded-md">
                <x-media-video-list-player
                    :snapshot="$item->snapMaxRes()"
                    :trailer-key="$item->trailerKey()"
                />
            </div>
        </div>
        <div class="flex basis-1/2 md:basis-1/3 flex-1 justify-center p-2">
            <div class="relative aspect-video overflow-hidden rounded-md">
                <img src="{{$item->snapHighRes()}}" 
                     alt=""
                     class="object-cover w-full h-full" 
                     loading="lazy">
                <a href="" class="absolute bottom-[8%] left-[5%] p-[2%] border-2 border-white rounded-full flex justify-center items-center bg-zinc-800/70">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#ffffff" stroke="transparent" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-icon lucide-play"><polygon points="6 3 20 12 6 21 6 3"/></svg>
                </a>
            </div>
        </div>
        <div class="flex basis-1/2 md:basis-1/3 flex-1 justify-center p-2">
            <div class="relative aspect-video overflow-hidden rounded-md">
                <img src="{{$item->snapHighRes()}}" 
                     alt=""
                     class="object-cover w-full h-full" 
                     loading="lazy">
                <a href="" class="absolute bottom-[8%] left-[5%] p-[2%] border-2 border-white rounded-full flex justify-center items-center bg-zinc-800/70">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#ffffff" stroke="transparent" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-icon lucide-play"><polygon points="6 3 20 12 6 21 6 3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>


