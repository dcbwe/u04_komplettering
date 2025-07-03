<?php

namespace App\DTO\Nested;

class ReviewCollection {
    /** @var ReviewDTO[] */
    public function __construct(public readonly array $reviews) {}

    public static function fromArray(array $items): self {
        return new self($items);
    }

    public function isEmpty(): bool {
        return empty($this->reviews);
    }
    
    public function all(): array {
        return $this->reviews;
    }
}
