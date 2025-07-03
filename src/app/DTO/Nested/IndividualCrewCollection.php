<?php
namespace App\DTO\Nested;

class IndividualCrewCollection {
    /** @var IndividualCrewDTO[] */
    public function __construct(public readonly array $individualCrew) {}

    public static function fromArray(array $items): self {
        return new self(array_map(fn($item) => new IndividualCrewDTO(
            $item['id'],
            $item['title'] ?? ($item['name'] ?? ''),
            $item['poster_path'] ?? null,
            $item['job'] ?? '',
            $item['release_date'] ?? ($item['first_air_date'] ?? ''),
            $item['media_type'] ?? '',
        ), $items));
    }

    public function filterByType(string $mediaType): array {
        return array_filter($this->individualCrew, fn(IndividualCrewDTO $individualCrew) =>
            strtolower($individualCrew->mediaType) === strtolower($mediaType)
        );
    }

    public function all(): array {
        return $this->individualCrew;
    }
}
