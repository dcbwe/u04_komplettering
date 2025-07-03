<?php

namespace App\ViewModels;

use App\DTO\Nested\VideoCollection;
use App\ViewModels\VideoGalleryItemViewModel;

class VideoGalleryViewModel {
    /** @var VideoGalleryItemViewModel[] */
    public readonly array $items;

    public function __construct(VideoCollection $collection) {
        $this->items = collect($collection->videos)
            ->filter(fn($video) => $video->youtubeSnapshotUrlAll())
            ->map(fn($video) => new VideoGalleryItemViewModel(
                $video->youtubeSnapshotUrlAll(),
                $video->youtubeSnapshotUrlAll(),
                $video->name
            ))
            ->values()
            ->all();
    }

    public function getIndexed(int $index): ?VideoGalleryItemViewModel {
        return $this->items[$index] ?? null;
    }
}
