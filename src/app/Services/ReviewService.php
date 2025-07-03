<?php

namespace App\Services;

use App\DTO\Nested\{ReviewDTO, ReviewCollection};
use Illuminate\Support\Facades\DB;

class ReviewService {
    public function fetchForMedia(string $type, string $mediaId, int $limit = 4): ReviewCollection {
        return new ReviewCollection(DB::table('reviews')
        ->join('users', 'users.id', '=', 'reviews.user_id')
        ->leftJoin('ratings', function ($join) use ($type) {
            $join->on('ratings.user_id', '=', 'reviews.user_id')
                 ->where('ratings.media_type', $type)
                 ->whereColumn('ratings.media_id', 'reviews.media_id');
        })
        ->where('reviews.media_type', $type)
        ->where('reviews.media_id', $mediaId)
        ->where('reviews.approved', true)
        ->orderByDesc('reviews.created_at')
        ->limit($limit)
        ->select([
            'reviews.id as review_id',
            'reviews.user_id',
            'reviews.content',
            'reviews.created_at as review_created_at',
            'users.username as username',
            'ratings.rating as user_rating'
        ])
        ->get()
            ->map(fn($r) => new ReviewDTO(
                id: $r->review_id,
                userId: $r->user_id,
                content: $r->content,
                createdAt: $r->review_created_at,
                userName: $r->username ?? null,
                userRating: $r->user_rating ?? null,
            ))
            ->all()
        );
    }

    public function fetchUserReview(string $type, string $mediaId): ?ReviewDTO {
        $userId = auth()->id();
        if (!$userId) return null;
    
        $row = DB::table('reviews')
        ->join('users', 'users.id', '=', 'reviews.user_id')
        ->leftJoin('ratings', function ($join) use ($type) {
            $join->on('ratings.user_id', '=', 'reviews.user_id')
                 ->where('ratings.media_type', $type)
                 ->whereColumn('ratings.media_id', 'reviews.media_id');
        })
        ->where('reviews.media_type', $type)
        ->where('reviews.media_id', $mediaId)
        ->where('reviews.user_id', $userId)
        ->select([
            'reviews.id as review_id',
            'reviews.user_id',
            'reviews.content',
            'reviews.created_at as review_created_at',
            'users.username as username',
            'ratings.rating as user_rating',
        ])
        ->first();
    
        return $row ? new ReviewDTO(
            id: $row->review_id,
            userId: $row->user_id,
            content: $row->content,
            createdAt: $row->review_created_at,
            userName: $row->username,
            userRating: $row->user_rating ?? null,
        ) : null;
    }
    
}
