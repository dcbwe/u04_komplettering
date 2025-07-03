@php $i = 1; @endphp
<div class="flex flex-col bg-zinc-900 sm:bg-zinc-950 w-full max-w-7xl py-6 gap-3">
    <x-title :title="$title" subtitle="Previous months" />
        
    <div class="grid grid-cols-1 sm:grid-cols-2 w-full sm:gap-x-10 p-1">
        @foreach($items as $item)
        @if($i <= 6)
        <div class="flex flex-row w-full hover:brightness-70 overflow-hidden py-1.5">

            <div class="flex justify-center items-center gap-2">
                <p class="text-white text-sm sm:text-base align-right w-2">{{$i}}</p>
                @php $i++; @endphp
                <span class="text-green-400">|</span>
            </div>

            <div class="relative flex justify-center items-center">
                <x-bookmark-toggle :item="$item"/>
            </div>
                    
            <div class="flex flex-col justify-center flex-grow overflow-hidden">
                <a href="{{ $item->route() }}" 
                   class="text-white text-sm sm:text-base font-bold whitespace-nowrap truncate hover:text-green-400 hover:underline decoration-rose-500">
                   {{$item->title}}
                </a>
                <span class="text-white text-xs">${{ number_format($item->revenue / 1_000_000, 1) }}M</span>
            </div>

            <div class="rotate-145 flex justify-end items-center p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#3b82f6" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket-icon lucide-ticket"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
            </div>

        </div>
        @endif
        @endforeach
    </div>
</div>