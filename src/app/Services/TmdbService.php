<?php

namespace App\Services;

use App\Resolvers\TmdbResolver;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class TmdbService {
    public function __construct(protected TmdbResolver $resolver) {}

    public function request(string $identifier, array $context = []): array {
        return Http::withHeaders($this->resolver->resolveHeaders())
            ->get($this->resolver->resolveEndpoint($identifier, $context),
                  $this->resolver->resolveParams($identifier, $context))
            ->json();
    }

    public function requestBatch(array $items): array {
        return array_map(
            fn($response) => $response->json(),
            Http::pool(fn(Pool $pool) =>
                collect($items)
                    ->map(fn($item) => $pool->withHeaders($this->resolver->resolveHeaders())
                        ->get(
                            $this->resolver->resolveEndpoint($item['media_type'], $item),
                            $this->resolver->resolveParams($item['media_type'], $item)
                        )
                    )->all()
            )
        );
    }
    
}
