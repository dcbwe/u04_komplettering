<div class="w-full max-w-7xl flex p-1 py-3">
@foreach ($window as $i => $items)
    @if ($i === 0)
        <x-trailer :items="$items" :total="count($window)" />
        <div class="hidden lg:flex flex-col w-fit h-full justify-between gap-1 pb-2">
            <span class="w-full px-3 text-xl font-bold text-blue-500 text-left align-center">Up next</span>
            <div class="flex flex-col justify-center gap-3">
    @else
                <x-trailer-extra :items="$items"/>
    @endif
    @endforeach
            </div>
            <div class="hidden lg:flex flex-row justify-start items-center">
                <h2 class="pl-3 text-xl font-bold text-green-400 text-left">Browse trailers</h2>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
            </div>
        </div>
</div>
