<?php

namespace App\DTO\Nested;

class CastCollection {
    /** @var CastDTO[] */
    public function __construct(public readonly array $cast) {}

    public static function fromArray(array $items): self {
        return new self(array_map(fn($item) => new CastDTO(
            $item['id'],
            $item['name'],
            $item['character'] ?? '',
            $item['profile_path'] ?? '',
            $item['order'] ?? 0,
        ), $items));
    }

    public function top(int $limit = 10): array {
        return array_slice($this->cast, 0, $limit);
    }
    
}
