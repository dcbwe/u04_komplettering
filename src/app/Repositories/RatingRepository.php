<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RatingRepository {
    public function averageRatings(string $type, array $ids): array {
        return DB::table('ratings')
            ->select('media_id', DB::raw('AVG(rating) as avg'))
            ->where('media_type', $type)
            ->whereIn('media_id', $ids)
            ->groupBy('media_id')
            ->pluck('avg', 'media_id')
            ->map(fn($avg) => round($avg, 1))
            ->toArray();
    }

    public function userRatings(string $type, array $ids, int $userId): array {
        return DB::table('ratings')
            ->select('media_id', 'rating')
            ->where('media_type', $type)
            ->where('user_id', $userId)
            ->whereIn('media_id', $ids)
            ->pluck('rating', 'media_id')
            ->toArray();
    }
}
