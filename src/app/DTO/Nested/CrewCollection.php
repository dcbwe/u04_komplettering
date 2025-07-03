<?php

namespace App\DTO\Nested;

class CrewCollection {
    /** @var CrewDTO[] */
    public function __construct(public readonly array $crew) {}

    public static function fromArray(array $items): self {
        return new self(array_map(fn($item) => new CrewDTO(
            $item['id'],
            $item['name'],
            $item['department'] ?? '',
            $item['job'] ?? '',
            $item['profile_path'] ?? '',
        ), $items));
    }

    public function filterByDepartment(string $department): array {
        return array_filter($this->crew, fn(CrewDTO $crew) =>
            strtolower($crew->department) === strtolower($department)
        );
    }

    public function filterByJob(string $job): array {
        return array_filter($this->crew, fn(CrewDTO $crew) =>
            strtolower($crew->job) === strtolower($job)
        );
    }
}
