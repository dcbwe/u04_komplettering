<?php

namespace App\Services;

use App\Factories\MediaItemDTOFactory;
use App\Resolvers\LocalResolver;
use Illuminate\Support\Facades\Cache;

class LocalListService {
    public function __construct(
        protected LocalResolver $local,
        protected TmdbService $tmdb,
        protected MediaRatingService $ratings,
    ) {}

    public function handle(string $configKey): array {
        return $this->ratings->injectRatings(
            array_map(
                fn($data) => MediaItemDTOFactory::mapItem($data),
                $this->mergeData($this->getItems($configKey))
            )
        );
    }

    public function handleRevenue(array $items): array {
        return array_map(
            fn($data) => MediaItemDTOFactory::mapItem($data),
            $this->mergeData($items)
        );
    }

    public function handleTrailer(array $items): array {
        return array_map(
            fn($data) => MediaItemDTOFactory::mapItem($data),
            $this->mergeData($items)
        );
    }
    
    
    protected function mergeData(array $items): array {
        return $this->mergeResults(
            $cached = $this->getCached(array_keys($keyed = $this->keyBy($items))),
            $this->getMissingKeys($cached)
                ? $this->fetchAndRestoreTypes(
                    array_intersect_key($keyed, array_flip($this->getMissingKeys($cached)))
                  )
                : []
        );
    }
    protected function getMissingKeys(array $cached): array {
        return array_keys(array_filter($cached, fn($v) => $v === null));
    }

    protected function mergeResults(array $cached, array $fetched): array {
        return array_filter(array_merge($cached, $fetched));
    }
    
    protected function keyBy(array $items): array {
        return array_combine(
            array_map(fn($item) => ((array)$item)['media_type'] . ':' . ((array)$item)['media_id'], $items),
            array_map(fn($item) => (array)$item, $items)
        );
    }
    
    protected function getCached(array $keys): array {
        return Cache::many($keys);
    }

    protected function setCached(array $fetched): void {
        array_walk($fetched, fn($data, $key) => Cache::put($key, $data, 86400));
    }
    
    protected function fetchAndRestoreTypes(array $notCached): array {
        return tap(
            $this->combineWithKeys(
                $notCached,
                $this->mergeTypeAndResponse(
                    $this->getOriginals($notCached),
                    $this->fetchFromTmdb($this->getOriginals($notCached))
                )
            ),
            fn($combined) => $this->setCached($combined)
        );
    }

    protected function getOriginals(array $notCached): array {
        return array_values($notCached);
    }

    protected function fetchFromTmdb(array $originals): array {
        return $this->tmdb->requestBatch($originals);
    }

    protected function mergeTypeAndResponse(array $originals, array $responses): array {
        return array_map(
            fn($orig, $data) => $data ? ['media_type' => $orig['media_type'], ...(array)$data] : [],
            $originals,
            $responses
        );
    }

    protected function combineWithKeys(array $notCached, array $values): array {
        return array_combine(array_keys($notCached), $values);
    }

    protected function getItems(string $configKey): array {
        return $this->local->resolve($configKey);
    }
}