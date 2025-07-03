<?php

namespace App\DTO\Nested;

class CrewDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $department,
        public readonly string $job,
        public readonly string $profilePath,
    ) {}
}
