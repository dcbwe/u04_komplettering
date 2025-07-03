<x-app-layout>
<div class="relative min-h-fit w-full max-w-7xl mx-auto rounded-md overflow-hidden shadow-lg bg-zinc-900 md:flex">
    {{-- Poster --}}
    <div class="w-full md:w-1/4 bg-zinc-800">
        <img src="{{ $person->imageUrl() }}" 
             alt="{{ $person->title }}" 
             class="w-full h-full object-cover rounded-t-lg md:rounded-none md:rounded-l-lg">
    </div>

    {{-- Info Section --}}
    <div class="w-full md:w-2/3 p-1 lg:p-3 flex flex-col justify-between gap-4 md:gap-0">
        <div class="flex flex-row justify-between overflow-hidden w-full">
            <div class="w-full">
                <div class="flex justify-between m-auto">
                    <p class="text-sm text-yellow-400 brightness-400">
                        Person • {{ $person->released() }}{{ $person->isDead() }} • {{ $person->placeOfBirth }}
                    </p>
                </div>
                <h1 class="text-xl md:text-3xl text-white font-bold line-clamp-2">
                    {{ $person->title }}
                </h1>
            </div>

        </div>

        {{-- Tagline --}}
        <blockquote class="italic text-green-400 text-sm border-l-4 rounded-sm border-rose-500 pl-2">
                    “{{ $person->knownForDepartment }}”
        </blockquote>

        {{-- Overview + Genres --}}
        <div>
            <p class="text-md text-white max-w-[65ch]">{{ $person->biography }}</p>
        
    </div>
    </div>

</div>

<div class="flex flex-col sm:grid sm:grid-cols-3 sm:grid-flow-col gap-2 p-2 w-full max-w-7xl overflow-hidden">
    <h3 class="text-md text-yellow-400 brightness-400 font-semibold hidden sm:flex sm:col-1">Movies</h3>
    <h3 class="text-md text-yellow-400 brightness-400 font-semibold hidden sm:flex sm:col-2">TV Shows</h3>
    <h3 class="text-md text-yellow-400 brightness-400 font-semibold hidden sm:flex sm:col-3">Crew</h3>
    <h3 class="text-md text-yellow-400 brightness-400 font-semibold flex sm:hidden">Movies, TV Shows N' Cast</h3>

    @foreach($person->credits->individualCast->all() as $credit)
        @php 
            $col = $credit->mediaType === 'movie' 
                 ? 'sm:col-1' 
                 : 'sm:col-2'; 
        @endphp

        <a href="{{ $credit->route() }}" class="flex bg-zinc-800 p-2 rounded-md {{ $col }}">
            @if($credit->posterPath)
                <img 
                    src="{{ $credit->imageUrl() }}" 
                    alt="{{ $credit->title }}" 
                    class="rounded w-10 aspect-3/4"
                >
            @endif

            <div class="flex flex-col px-2 overflow-hidden">

                <p class="text-xs text-yellow-400 brightness-400 truncate">
                    {{ $credit->released() }}
                </p>

                <p class="text-sm text-green-500 truncate">
                    {{ $credit->title }}
                </p>

                @if(!empty($credit->character))
                    <p class="text-xs text-indigo-400 truncate">
                        as {{ $credit->character }}
                    </p>
                @endif

            </div>
        </a>
    @endforeach
    @foreach($person->credits->individualCrew->all() as $crew)
    <a href="{{ $crew->route() }}"
       class="flex bg-zinc-800 p-2 rounded-md sm:col-3">
        
        @if($crew->posterPath)
            <img src="{{ $crew->imageUrl() }}"
                 alt="{{ $crew->title }}"
                 class="rounded w-10 aspect-3/4">
        @endif

        <div class="flex flex-col px-2 overflow-hidden">
            <p class="text-xs text-yellow-400 brightness-400 truncate">
                {{ $crew->released() }}
            </p>
            <p class="text-sm text-green-500 truncate">
                {{ $crew->title }}
            </p>
            <p class="text-xs text-indigo-400 truncate">
                {{ $crew->job }}
            </p>
        </div>
    </a>
@endforeach

</div>

</x-app-layout>