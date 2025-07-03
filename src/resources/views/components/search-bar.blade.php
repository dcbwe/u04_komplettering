<form action="{{ route('media.search') }}" method="GET" class="flex flex-col sm:flex-row gap-2 min-w-full">
    <div class="flex justify-between w-full rounded-md">
        <select name="type" 
                class="bg-green-500 rounded-l-md text-zinc-900 focus:outline-none text-md font-semibold cursor-pointer"
                aria-label="Search by filter"
                title="Search by filter">
            <option class="font-semibold" value="multi" {{ $type === 'multi' ? 'selected' : '' }}>All</option>
            <option class="font-semibold" value="movie" {{ $type === 'movie' ? 'selected' : '' }}>Movie</option>
            <option class="font-semibold" value="tv" {{ $type === 'tv' ? 'selected' : '' }}>TV</option>
            <option class="font-semibold" value="person" {{ $type === 'person' ? 'selected' : '' }}>People</option>
        </select>

        <input type="text"
               name="q"
               value="{{ $query }}"
               placeholder="Search NPMDb..."
               aria-label="Search"
               class="px-3 py-1 w-full focus:outline-none bg-zinc-100">
               
        <button type="submit" class="flex justify-center items-center hover:bg-green-500 bg-zinc-100 rounded-r-md w-fit font-bold text-lg px-2 py-0 cursor-pointer">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class=""><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        </button>
        </div>
</form>
