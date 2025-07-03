<section class="w-full max-w-7xl py-6 bg-zinc-900 sm:bg-zinc-950">
    <x-title :title="$title" :subtitle="$subtitle"/>
    <div class="relative">
    @if (count($items))
        <div class="overflow-x-auto">
            <div class="flex space-x-3 p-1">
                @foreach ($items as $item)
                    @if($item->type() !== 'person')
                    <x-media-card :item="$item" />
                    @else
                    <x-media-card-person :item="$item" :rank="$loop->iteration"/>
                    @endif
                @endforeach
            </div>
        </div>
    @if (count($items) > 6)
    <div class="pointer-events-none absolute top-0 right-0 h-full w-10 bg-gradient-to-l from-yellow-400/20 to-transparent flex justify-center"></div>
    @endif
    @else
        <p class="text-sm text-gray-500 py-20">Nothing to show...</p>
    @endif
</section>

