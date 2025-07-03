<?php

namespace App\DTO\Nested;

class ReviewDTO {
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly string $content,
        public readonly string $createdAt,
        public readonly ?string $userName,
        public readonly ?int $userRating = null,
    ) {}

    public function getUserRating(): string {
        return $this->userRating
            ? $this->userRating.'/10'
            : 'n/a';
    }
}
