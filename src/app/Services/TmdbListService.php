<?php

namespace App\Services;

use App\Factories\MediaItemDTOFactory;
use Illuminate\Support\Facades\Cache;

class TmdbListService {
    public function __construct(
        protected TmdbService $tmdb,
        protected MediaRatingService $ratings,
    ) {}

    public function handle(string $source, string $configKey): array {
        $type = $this->getTmdbType($configKey);
    
        return $this->ratings->injectRatings(
            array_filter(array_map(
                fn($item) => MediaItemDTOFactory::mapItem([
                    'media_type' => $type,
                    ...(array) $item
                ]),
                $this->fetchTmdbList($source, $configKey)['results'] ?? []
            ))
        );
    }
    
    public function getRevenue(string $source, string $configKey): array {
        $type = $this->getTmdbType($configKey);
        return array_map(
            fn($item) => ['media_type' => $type, 'media_id' => $item['id']],
            $this->fetchTmdbList($source, $configKey)['results'] ?? []
        );
    }

    public function getTrailer(string $source, string $configKey): array {
        $type = $this->getTmdbType($configKey);
        return array_map(
            fn($item) => ['media_type' => $type, 'media_id' => $item['id']],
            $this->fetchTmdbList($source, $configKey)['results'] ?? []
        );
    }

    protected function getTmdbType(string $configKey): string {
        return ConfigService::tmdbMediaType($configKey);
    }

    protected function fetchTmdbList(string $source, string $configKey): array {
        return (array)Cache::remember(
            "$source:$configKey",
            86400,
            fn() => $this->tmdb->request($configKey)
        );
    }
}