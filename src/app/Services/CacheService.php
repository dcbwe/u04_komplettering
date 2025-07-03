<?php 

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CacheService {
    public static function key(string $type, string|int $id): string {
        return $type . ':' . Str::slug($id, ':');
    }

    public function has(string $key): bool {
        return Cache::has($key);
    }

    public function get(string $key, mixed $default = null): mixed {
        return Cache::get($key, $default);
    }

    public function put(string $key, mixed $value, int $ttl = 300): void {
        Cache::put($key, $value, $ttl);
    }

    public function splitByCache(array $items, callable $keyResolver): array {
        $itemsWithKeys = collect($items)->map(fn($item) => [
            ...(array) $item,
            'cache_key' => $keyResolver((array) $item),
        ]);
    
        $cached = $itemsWithKeys
            ->filter(fn($item) => $this->has($item['cache_key']))
            ->mapWithKeys(fn($item) => [$item['cache_key'] => $this->get($item['cache_key'])])
            ->all();
    
        $uncached = $itemsWithKeys
            ->reject(fn($item) => isset($cached[$item['cache_key']]))
            ->values()
            ->all();
    
        return compact('cached', 'uncached');
    }
    
}

