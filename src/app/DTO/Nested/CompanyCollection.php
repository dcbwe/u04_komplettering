<?php

namespace App\DTO\Nested;

class CompanyCollection {
    /** @var CompanyDTO[] */
    public function __construct(public readonly array $companies) {}

    public static function fromArray(array $items): self {
        return new self(array_map(fn($company) => new CompanyDTO(
            $company['id'],
            $company['logo_path'] ?? '',
            $company['name'],
            $company['origin_country'] ?? '',
        ), $items));
    }
}