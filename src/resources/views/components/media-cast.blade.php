<div class="flex flex-col bg-zinc-900 sm:bg-zinc-950 w-full max-w-7xl py-6 gap-3 min-h-fit">
        <div class="flex w-full">
            <x-title title="Top cast"/>
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=""><path d="m9 18 6-6-6-6"/></svg>
        </div>
    <div class="flex flex-row sm:grid sm:grid-cols-2 w-full gap-3 overflow-x-auto">

        @foreach($casts->top() as $act)
        <div class="flex flex-col sm:flex-row w-full gap-2">

            <div class="flex justify-center items-center size-30">
                <img class="rounded-full size-30" src="{{ $act->imagePreview() }}" alt="{{ $act->name }}">                
            </div>

            <div class="flex flex-col justify-center">

                <a href="{{ $act->route() }}" 
                   class="text-sm sm:text-base font-bold text-white hover:text-green-400 hover:underline decoration-rose-500  line-clamp-1 leading-tight">{{ $act->name }}
                </a>

                <span class="text-sm sm:text-base font-normal text-indigo-400 line-clamp-1 leading-tight">
                    {{ $act->character }}
                </span>

            </div>

        </div>
        @endforeach
    </div>
</div>