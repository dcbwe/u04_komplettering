<x-app-layout>
    <section class="flex flex-col h-full w-full max-w-7xl p-1 gap-4 mt-0 mb-auto">
        <form action="{{ route('profile') }}" method="GET" class="flex flex-row items-start overflow-y-auto">
            @foreach($lists as $slug => $listname)
                <button type="submit" name="listname" value="{{ $slug }}"
                   class="flex flex-none py-1 text-sm sm:text-lg font-semibold hover:text-green-400 border-b-2 hover:border-b-rose-500 transition px-3 cursor-pointer {{ ($current ?? '') === $slug ? 'text-green-400 border-b-rose-500' : 'text-white' }}">
                    {{ $listname['title'] }}
                </button>
            @endforeach
        </form>
        @if(isset($list))
        <div class="flex flex-wrap gap-3 mt-3">
            @foreach($list['items'] as $item)
                <x-media-card :item="$item"/>
            @endforeach
        </div>
        @endif
    </section>
</x-app-layout>
