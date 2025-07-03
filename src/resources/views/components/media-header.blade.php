@props(['media'])
<div class="relative min-h-fit w-full max-w-7xl mx-auto rounded-lg overflow-hidden shadow-lg bg-zinc-900 md:flex">
@if($media->media_type === 'person')
    <div class="flex flex-col w-full h-full">
        <div class="flex flex-col sm:flex-row w-full">

            <div class="w-full md:w-1/4 bg-zinc-800">
                @if ($media->profile_path)
                    <img src="https://image.tmdb.org/t/p/w342{{ $media->profile_path }}" 
                         alt="{{ $media->name }}" 
                         class="w-full h-full object-cover rounded-t-lg md:rounded-none md:rounded-l-lg">
                @endif
            </div>

            <div class="w-full h-full md:w-2/3 p-4 flex flex-col space-y-4">
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold text-white">{{ $media->name }}</h1>
                    <p class="text-sm text-gray-400">
                        {{ $media->known_for_department ?? 'No department listed' }}
                    </p>
                </div>

                @if(!empty($media->birthday))
                <div class="flex flex-col text-sm text-gray-300 space-y-1">
                    <span><strong>Born:</strong> {{ \Carbon\Carbon::parse($media->birthday)->format('M d, Y') }}</span>
                    @if (!empty($media->place_of_birth))
                        <span><strong>Place:</strong> {{ $media->place_of_birth }}</span>
                    @endif
                </div>
                @endif

                @if(!empty($media->biography))
                <div>
                    <h2 class="text-lg text-lime-400 font-semibold">Biography</h2>
                    <p class="text-gray-300 mt-2">{{ $media->biography }}</p>
                </div>
                @endif
            </div>
        </div>
        @if(!empty($media->media))
            <div class="grid sm:grid-cols-2 sm:grid-flow-col gap-2 p-2">
                <h3 class="text-md text-lime-400 font-semibold hidden sm:flex sm:col-1">Movies</h3>
                <h3 class="text-md text-lime-400 font-semibold hidden sm:flex sm:col-2">TVShows</h3>
                <h3 class="text-md text-lime-400 font-semibold flex sm:hidden">Movies & TVShows</h3>
                @foreach($media->media as $work)
                    @if($work['media_type'] === 'movie')
                        <a href="{{ media_url($work['media_type'], $work['id']) }}" class="flex bg-zinc-800 p-2 rounded-lg sm:col-1">
                    @elseif($work['media_type'] === 'tv')
                        <a href="{{ media_url($work['media_type'], $work['id']) }}" class="flex bg-zinc-800 p-2 rounded-lg sm:col-2">
                    @endif
                        @if ($work['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w185{{ $work['poster_path'] }}" 
                                 alt="{{ $work['title'] ?? $work['name']}}"
                                 class="rounded w-10 aspect-3/4">
                        @endif
                        <div class="flex flex-col px-2">
                        <p class="text-xs text-white truncate">{{ $work['release_date'] ?? $work['first_air_date'] }}</p>
                        <p class="text-sm text-lime-500 truncate">{{ $work['title'] ?? $work['name'] }}</p>
                        @if(!empty($work['character']))
                            <p class="text-xs text-gray-400 truncate">as {{ $work['character'] }}</p>
                        @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>



@else
    {{-- Poster --}}
    <div class="w-full md:w-1/4 bg-zinc-800">
        @if ($media->poster_path)
            <img src="https://image.tmdb.org/t/p/w342{{ $media->poster_path }}" 
                 alt="{{ $media->title ?? $media->name }}" 
                 class="w-full h-full object-cover rounded-t-lg md:rounded-none md:rounded-l-lg">
        @endif
    </div>
    {{-- Info Section --}}
    <div class="w-full md:w-2/3 p-4 flex flex-col justify-between space-y-4">
        
        <div class="flex flex-row justify-between w-full">

        <div>
            <p class="text-sm text-gray-400">
                {{ ucfirst($media->media_type)}}
                • 
                {{ \Carbon\Carbon::parse($media->release_date)->format('Y') ?? 'Unknown year' }}
                • 
                @if($media->media_type !== 'tv')
                {{ $media->runtime ?? '??' }} min
                @else
                {{ is_array($media->seasons) ? count($media->seasons) : '??' }} seasons
                @endif
            </p>
            <h1 class="text-2xl md:text-4xl text-white font-bold line-clamp-2">
                {{ $media->title ?? $media->name }}
            </h1>
        </div>

        {{-- Ratings --}}
        <div class="flex flex-col items-start justify-end gap-1 p-3 sm:hidden">
            {{-- Total Rating --}}
            <div class="flex items-center gap-1 text-white align-left">
                <svg class="w-4.5 h-4.5" fill="#a3e635" stroke="#a3e635" viewBox="0 0 24 24">
                    <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845L19.336 24 12 19.897 4.664 24 6 15.593 0 9.748l8.332-1.73z"/>
                </svg>
                <span class="text-md">{{ number_format($media->average_rating, 1) }}</span>
            </div>

            {{-- Your Rating (auth required) --}}
            <x-rating :media="$media"/>
        </div>

        </div>
        {{-- Tagline --}}
            @if (!empty($media->tagline))
            <blockquote class="italic text-gray-300 text-sm border-l-4 border-lime-500 pl-4 my-1">
                “{{ $media->tagline }}”
            </blockquote>
            @endif
        

        <div>
        {{-- Genre --}}
        @if (!empty($media->genres))
        <div class="flex flex-wrap gap-3 py-4">
        <p class="text-md text-white py-2">
                    {{ $media->overview ?? ''}}
         </p>
                @foreach ($media->genres as $genre)
                    <span class="px-3 py-1 text-xs font-semibold bg-zinc-800 text-lime-400 rounded-full">
                        {{ $genre }}
                    </span>
                @endforeach
            </div>
        @endif

        @if($media->media_type === 'movie')
        <div class="w-full border-t-1 border-b-1 border-zinc-700 flex justify-start items-center py-3">
            <p class="text-sm sm:text-lg font-bold text-white">Writer</p>
            @foreach ($media->Director as $director)
                <p class="text-sm sm:text-md text-lime-400 px-3">•</p>
                <span class="text-sm sm:text-md text-lime-400">{{$director['name']}}</span>
            @endforeach
        </div>
        @elseif($media->media_type === 'tv')
        <div class="w-full border-t-1 border-b-1 border-zinc-700 flex justify-start items-center py-3">
            <p class="text-sm sm:text-lg font-bold text-white">Created by</p>
            @foreach ($media->created_by as $creator)
                <p class="text-sm sm:text-md text-lime-400 px-3">•</p>
                <span class="text-sm sm:text-md text-lime-400">{{$creator}}</span>
            @endforeach
        </div>
        @endif
        <div class="w-full border-b-1 border-zinc-700 flex items-center py-3 gap-1">
            <p class="text-sm sm:text-lg font-bold text-white">Producer</p>
            @foreach ($media->Producer as $producer)
                <p class="text-sm sm:text-md text-lime-400 px-3">•</p>
                <span class="text-sm sm:text-md text-lime-400">{{$producer['name']}}</span>
            @endforeach
        </div>
        <div class="w-full border-b-1 border-zinc-700 flex items-center py-3 gap-1 wrap">
            <p class="text-sm sm:text-lg font-bold text-white">Production Corp</p>
            @foreach ($media->production_companies as $production)
                <p class="text-sm sm:text-md text-lime-400 px-3">•</p>
                <span class="text-sm sm:text-md text-lime-400">{{$production}}</span>
            @endforeach
        </div>
        </div>
    </div>
    {{-- Ratings --}}
    <div class="hidden sm:flex flex-col items-start justify-start gap-2 p-4 h-full w-auto">
        {{-- Total Rating --}}
        <div class="flex items-center gap-1 text-white">
            <svg class="w-4.5 h-4.5" fill="#a3e635" stroke="#a3e635" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845L19.336 24 12 19.897 4.664 24 6 15.593 0 9.748l8.332-1.73z"/>
            </svg>
            <span class="text-md">{{ number_format($media->average_rating, 1) }}</span>
        </div>

        {{-- Your Rating (auth required) --}}
        <x-rating :media="$media"/>
    </div>
@endif
</div>