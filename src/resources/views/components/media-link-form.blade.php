@props(['item'])

<form action="{{ $item->route() }}" method="GET">
    @csrf
    <input type="hidden" name="media_id" value="{{ $item->id }}">
    <input type="hidden" name="media_type" value="{{ $item->type() }}">
    <input type="hidden" name="adult" value="{{ $item->adult }}">

    <button type="submit" class="text-white text-sm sm:text-base hover:text-green-400 hover:underline decoration-rose-500 text-center font-semibold line-clamp-2 leading-tight mt-0 mb-auto px-1">
        {{ $item->title }}
    </button>
</form>

