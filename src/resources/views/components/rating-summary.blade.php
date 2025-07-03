@props(['mediaId', 'mediaType'])

@php
    use App\Models\Rating;

    $ratings = Rating::where('media_id', $mediaId)
                     ->where('media_type', $mediaType)
                     ->pluck('rating');

    $average = $ratings->avg();
    $count = $ratings->count();
@endphp

@if ($count > 0)
    <div>
        <strong>Average Rating:</strong> {{ number_format($average, 1) }}/10
        <span>({{ $count }} {{ Str::plural('vote', $count) }})</span>
    </div>
@else
    <p>No ratings yet.</p>
@endif
