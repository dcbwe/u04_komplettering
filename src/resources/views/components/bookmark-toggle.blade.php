@props(['item'])

@php
    $isFavorite = auth()->check() && auth()->user()->hasInWatchlist($item);
@endphp

@if(auth()->check())
    <form method="POST" 
          action="{{ route('favorites.toggle', ['id' => $item->id, 'type' => $item->type()]) }}">

        @csrf

        <button type="submit"
                class="group p-1 cursor-pointer"
                aria-label="{{ $isFavorite ? 'Remove from bookmarks' : 'Add to bookmarks' }}"
                title="{{ $isFavorite ? 'Remove from bookmarks' : 'Add to bookmarks' }}">

            <x-icon-bookmark :active="$isFavorite" />

        </button>

    </form>

@else

    <a href="{{ route('users.login') }}"
       class="group p-1 cursor-pointer"
       aria-label="Logga in för att lägga till i favoriter"
       title="Logga in för att lägga till i favoriter">

       <x-icon-bookmark />

    </a>
    
@endif
