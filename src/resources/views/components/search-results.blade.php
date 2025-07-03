<div class="flex flex-wrap justify-center max-w-7xl gap-4">
    @forelse ($results as $item)
        <x-media-card :item="$item" />
    @empty
        <p>No results found.</p>
    @endforelse
</div>
