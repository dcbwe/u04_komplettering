<?php

namespace App\DTO\Nested;

class GenreDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}
}