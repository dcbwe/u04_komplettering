<div class="flex flex-col justify-between shrink-0 w-36 sm:w-42 lg:min-w-50 bg-zinc-900 rounded-md shadow-sm shadow-zinc-950 relative min-h-auto border-1 {{ colorShadow() }} gap-2">

    <img src="{{ $item->imagePreview() }}"
         alt="{{ $item->title }}"
         class="aspect-3/4 rounded shadow h-auto">

    <div class="flex justify-between items-center text-sm text-white gap-3 w-3/5 pl-2">

        <x-media-rating :item="$item" />
               
    </div>


    <a href="{{ $item->route() }}" 
       class="text-white text-sm sm:text-base hover:text-green-400 hover:underline decoration-rose-500 text-center font-semibold line-clamp-2 leading-tight mt-0 mb-auto px-1">
       {{ $item->title }}
    </a>

    <div class="flex justify-between">

        <span class="relative group place-self-center p-1 cursor-pointer">
            <x-icon-info />
            <span class="absolute left-0 bottom-[1.75rem] z-100 w-34 sm:w-42 lg:w-50 rounded bg-zinc-800 text-xs text-white shadow-lg opacity-0 group-hover:opacity-100 pointer-events-none transition p-1">
                <p class="place-self-center">
                    {{ Str::limit($item->info, 155) }}
                </p>
            </span>
        </span>

        <p class="text-xs sm:text-sm text-yellow-400 brightness-400 text-right p-1 pr-2">
            {{ $item->released() }}
        </p>
    </div>  

    <div class="absolute top-0 left-0 max-w-10 max-h-12 flex justify-center items-center m-0.5">
        <x-bookmark-toggle :item="$item" />
    </div>

</div>

