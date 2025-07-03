@props(['mediaId', 'mediaType'])

@php
    use App\Models\ListModel;

    $user = auth()->user();
    $lists = $user ? $user->lists()->get() : collect();
@endphp

@if ($user && $lists->count())
    <form action="{{ route('lists.addMedia', $lists->first()) }}" method="POST">
        @csrf
        <input type="hidden" name="media_id" value="{{ $mediaId }}">
        <input type="hidden" name="media_type" value="{{ $mediaType }}">

        <label for="list-select">Add to list:</label>
        <select name="list_id" id="list-select" onchange="this.form.action = '/lists/' + this.value + '/add'; this.form.submit()">
            <option disabled selected>Choose list...</option>
            @foreach ($lists as $list)
                <option value="{{ $list->id }}">{{ $list->title }}</option>
            @endforeach
        </select>
    </form>
@elseif(!$user)
    <p><a href="{{ route('login') }}">Log in</a> to use lists.</p>
@else
    <p>No lists available. <a href="{{ route('lists.index') }}">Create one?</a></p>
@endif
