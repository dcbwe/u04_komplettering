<x-app-layout>
    @foreach($lists as $slug => $list)
        @if($slug === 'watchlist')
            @auth
                <x-media-list :title="$list['title']" :subtitle="$list['subtitle']" :items="$list['items']"/>
            @else
                <x-watchlist-no-auth :title="$list['title']" :subtitle="$list['subtitle']"/>
            @endauth
        @elseif($slug === 'revenue')
            <x-revenue-list :title="$list['title']" :subtitle="$list['subtitle']" :items="$list['items']"/>
        @elseif($slug === 'trailer')
            <x-trailer-list :trailers="collect($lists['trailer']['items'])" />
        @else
            <x-media-list :title="$list['title']" :subtitle="$list['subtitle']" :items="$list['items']"/>
        @endif
    @endforeach
</x-app-layout>


