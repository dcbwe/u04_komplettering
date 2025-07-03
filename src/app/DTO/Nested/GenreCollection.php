<?php

namespace App\DTO\Nested;

class GenreCollection {
    /** @var GenreDTO[] */
    public function __construct(public readonly array $genres) {}

    public static function fromArray(array $items): self {
        return new self(array_map(fn($genre) => new GenreDTO(
            $genre['id'],
            $genre['name'],
        ), $items));
    }
}