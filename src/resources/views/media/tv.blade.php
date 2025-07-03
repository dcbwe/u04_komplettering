<x-app-layout>
<div class="relative min-h-fit w-full max-w-7xl mx-auto rounded-md overflow-hidden shadow-lg bg-zinc-900 md:flex">
    {{-- Poster --}}
    <div class="w-full md:w-1/4 bg-zinc-800">
        <img src="{{ $tv->imageUrl() }}" 
             alt="{{ $tv->title }}" 
             class="w-full h-full object-cover rounded-t-lg md:rounded-none md:rounded-l-lg">
    </div>

    {{-- Info Section --}}
    <div class="w-full md:w-2/3 p-1 lg:p-3 flex flex-col justify-between gap-4 md:gap-0">
        <div class="flex flex-row justify-between overflow-hidden w-full">
            <div class="w-full">
                <div class="flex justify-between m-auto">
                    <p class="text-sm text-yellow-400 brightness-400">
                        Movie • {{ $tv->released() }} • {{ $tv->numberOfEpisodes }} episodes
                    </p>
                    {{-- Ratings (mobile) --}}
                    <div class="flex items-start justify-end gap-1 md:hidden">
                        <x-media-rating :item="$tv"/>
                    </div>
                </div>
                <h1 class="text-xl md:text-3xl text-white font-bold line-clamp-2">
                    {{ $tv->title }}
                </h1>
            </div>

        </div>

        {{-- Tagline --}}
        <blockquote class="italic text-green-400 text-sm border-l-4 rounded-sm border-rose-500 pl-2">
                    “{{ $tv->tagline }}”
        </blockquote>

        {{-- Overview + Genres --}}
        <div>
            <p class="text-md text-white max-w-[65ch]">{{ $tv->overview }}</p>
            <div class="flex flex-wrap gap-3 py-3">
                @foreach ($tv->genreNames() as $genre)
                <span class="px-2 py-0.5 text-xs font-semibold border-2 border-rose-500 bg-zinc-800 text-green-500 rounded-md mr-1">
                        {{ $genre }}
                    </span>
                @endforeach
            </div>
        

        {{-- Crew Info --}}
        <div>
        <div class="w-full border-t border-b border-zinc-700 flex justify-start items-center py-3 gap-1 wrap">
            <p class="text-sm sm:text-lg font-bold text-green-400">Director</p>
            <div class="flex overflow-x-auto">
            @foreach ($tv->credits->directors() as $director)
                <p class="text-sm sm:text-md text-blue-500 px-3">•</p>
                <span class="text-sm sm:text-md text-blue-500 whitespace-nowrap">{{ $director->name }}</span>
            @endforeach
            </div>
        </div>
        <div class="w-full border-b border-zinc-700 flex items-center gap-1 wrap py-3">
            <p class="text-sm sm:text-lg font-bold text-green-400">Producer</p>
            <div class="flex overflow-x-auto">
            @foreach ($tv->credits->producers() as $producer)
                <p class="text-sm sm:text-md text-blue-500 px-3">•</p>
                <span class="text-sm sm:text-md text-blue-500 whitespace-nowrap">{{ $producer->name }}</span>
            @endforeach
            </div>
        </div>
        <div class="w-full border-b border-zinc-700 flex items-center gap-1 wrap py-3">
            <p class="text-sm sm:text-lg font-bold text-green-400">Production</p>
            <div class="flex overflow-x-auto">
            @foreach ($tv->companies->companies as $company)
                <p class="text-sm sm:text-md text-blue-500 px-3">•</p>
                <span class="text-sm sm:text-md text-blue-500 whitespace-nowrap">{{ $company->name }}</span>
            @endforeach
            </div>
        </div>
        </div>
    </div>
    </div>
    {{-- Ratings (desktop) --}}
    <div class="hidden md:flex flex-col items-start justify-start gap-2 py-4 h-full w-auto">

        <x-media-rating :item="$tv"/>
    </div>
</div>

    <x-media-review-list :item="$tv" :reviews="$reviews" :userReview="$userReview">
        <a href="#more" class="text-sm text-lime-400 underline">View all reviews</a>
    </x-media-review-list>

    <x-media-video-list :item="$tv->videos"/>


    <x-media-cast :casts="$tv->credits->cast"/>
</x-app-layout>