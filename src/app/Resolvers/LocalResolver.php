<?php

namespace App\Resolvers;

use Illuminate\Support\Facades\DB;
use App\Services\ConfigService;

class LocalResolver {
    public function resolve(string $key): array {
        return $this->resolveQuery(ConfigService::localDefinition($key) ?? $key);
    }

    protected function resolveQuery(string|array $listSettings): array {
        return match ($listSettings['key']) {
            'rating' => $this->rating($listSettings['isAuth']),
            'userlists' => $this->userlists(null),
            'popular_views' => $this->popular($listSettings['media_types']),
            'recent_views' => $this->recent($listSettings['isAuth']),
            default => $this->userlists($listSettings),
        };
    }

    // global top rated | user top rated
    protected function rating(bool $isAuth): array {
        return DB::table('ratings')
            ->when($isAuth,
                fn($q) => $q->where('user_id', auth()->id()))
            ->when(!$isAuth,
                fn($q) => $q->where('adult', false))
            ->select('media_id', 'media_type', DB::raw('AVG(rating) as avg_rating'))
            ->groupBy('media_id', 'media_type')
            ->orderByDesc('avg_rating')
            ->limit(30)
            ->get()
            ->toArray();
    }

    // Most viewed tv + movie | most viewed person 
    protected function popular(string|array $mediaTypes): array {
        return DB::table('media_views')
            ->select('media_id', 'media_type', DB::raw('COUNT(*) as views'))
            ->where('viewed_at', '>=', now()->subDays(30))
            ->where('adult', false)
            ->when(is_array($mediaTypes),
                fn($q) => $q->whereIn('media_type', $mediaTypes),
                fn($q) => $q->where('media_type', $mediaTypes),)
            ->groupBy('media_id', 'media_type')
            ->orderByDesc('views')
            ->limit(30)
            ->get()
            ->toArray();
    }

    //global trending | user recent
    protected function recent(bool $isAuth): array {
        return DB::table('media_views')
            ->when($isAuth, 
                fn($q) => $q->where('user_id', auth()->id()))
            ->when(!$isAuth,
                fn($q) => $q->where('adult', false))
            ->where('viewed_at', '>=', now()->subDays(30))
            ->whereIn('media_type', ['movie', 'tv'])
            ->select('media_id', 'media_type', DB::raw('MAX(viewed_at) as last_seen'))
            ->groupBy('media_id', 'media_type')
            ->orderByDesc('last_seen')
            ->limit(30)
            ->get()
            ->toArray();
    }

    // bound to users
    protected function userlists(?string $listname): array {
        if (!auth()->check())
            return [];
        return DB::table('list_media')
            ->join('lists', 'lists.id', '=', 'list_media.list_id')
            ->where('lists.user_id', auth()->id())
            ->when(isset($listname),
                fn($q) => $q->where('lists.title', $listname))
            ->select('media_id', 'media_type')
            ->orderByDesc('list_media.created_at')
            ->get()
            ->toArray();
    }
}
