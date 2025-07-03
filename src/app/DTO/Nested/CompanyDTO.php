<?php

namespace App\DTO\Nested;

class CompanyDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $logoPath,
        public readonly string $name,
        public readonly string $originCountry,
    ) {}
}