<?php

namespace App\Managers;

use App\DTO\MediaItemDTO;
use App\Factories\MediaItemDTOFactory;
use App\Services\MediaRatingService;
use App\Services\TmdbService;

class MediaManager {
    public function __construct(
        protected TmdbService $tmdb,
        protected MediaRatingService $ratings,
        protected MediaItemDTOFactory $factory
    ) {}

    public function fetch(string $type, int $id): MediaItemDTO {
        $data = $this->tmdb->request($type, ['media_type' => $type, 'media_id' => $id]);
        return $this->factory->mapItem([...$data, 'media_type' => $type]);
    }

    public function search(string $type, string $query): array {
        return $this->tmdb->request('search', ['media_type' => $type, 'search_query' => $query])['results'] ?? [];
    }

    protected function getSearch(string $type, string $query): array {
        return $query 
            ? $this->tmdb->request('search', ['media_type' => $type, 'search_query' => $query]) 
            : []
            ;
    }

    public function fetchSearch(string $type, string $query): array {
        return array_map(
                fn($item) => $this->factory->mapItem($item), 
                $this->tmdb->request('search', ['media_type' => $type, 'search_query' => $query])['results'] ?? []
        );
    }
}
