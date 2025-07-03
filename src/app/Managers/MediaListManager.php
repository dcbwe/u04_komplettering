<?php

namespace App\Managers;

use App\Resolvers\LocalResolver;
use App\Services\LocalListService;
use App\Services\TmdbListService;
use App\Services\TrailerListService;

class MediaListManager {
    public function __construct(
        protected LocalResolver $local,
        protected LocalListService $localList,
        protected TmdbListService $tmdbList,
        protected TrailerListService $trailerList,
    ) {}
    public function handle(string $source, string $configKey) {
        return match ($configKey) {
            'revenue' => $this->localList->handleRevenue(
                $this->tmdbList->getRevenue($source, $configKey)
            ),
            'trailer' => $this->trailerList->filterAndSort(
                $this->localList->handleRevenue(
                    $this->tmdbList->getRevenue($source, $configKey)
                )
            ),
            default => match ($source) {
                'local' => $this->localList->handle($configKey),
                'tmdb'  => $this->tmdbList->handle($source, $configKey),
            }
        };
    }
}
