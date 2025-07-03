@props(['mediaId', 'mediaType'])

<form action="{{ route('rating.store') }}" method="POST">
    @csrf
    <input type="hidden" name="media_id" value="{{ $mediaId }}">
    <input type="hidden" name="media_type" value="{{ $mediaType }}">

    <label for="rating">Rate:</label>
    <select name="rating" id="rating">
        @for ($i = 1; $i <= 10; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>

    <button type="submit">Submit</button>
</form>

