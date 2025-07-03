<?php

namespace App\Services;

use App\DTO\MediaItemDTO;
use App\Repositories\RatingRepository;
use App\Support\MediaCloner;
use Illuminate\Support\Facades\Auth;

class MediaRatingService {
    public function __construct(
        protected RatingRepository $ratings,
        protected MediaCloner $mutator
    ) {}

    public function injectRatings(array $items): array {
        if (empty($items)) return [];

        $first = reset($items);
        if (!is_object($first) || !method_exists($first, 'type')) return $items;

        $type = $first->type();
        $ids = array_map(fn(MediaItemDTO $item) => (string) $item->id, $items);

        $avg = $this->ratings->averageRatings($type, $ids);
        $userId = Auth::id();
        $user = $userId ? $this->ratings->userRatings($type, $ids, $userId) : [];

        return array_map(
            fn(MediaItemDTO $item) => $this->mutator->apply(
                $item,
                $avg[(string) $item->id] ?? null,
                $user[(string) $item->id] ?? null
            ),
            $items
        );
    }
}
