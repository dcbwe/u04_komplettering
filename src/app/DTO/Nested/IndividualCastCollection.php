<?php
namespace App\DTO\Nested;

class IndividualCastCollection {
    /** @var IndividualCastDTO[] */
    public function __construct(public readonly array $individualCast) {}

    public static function fromArray(array $items): self {
        return new self(array_map(fn($item) => new IndividualCastDTO(
            $item['id'],
            $item['title'] ?? ($item['name'] ?? ''),
            $item['character'] ?? '',
            $item['poster_path'] ?? null,
            $item['release_date'] ?? ($item['first_air_date'] ?? ''),
            $item['order'] ?? 0,
            $item['media_type'] ?? '',
        ), $items));
    }

    public function top(int $limit = 10): array {
        return array_slice($this->individualCast, 0, $limit);
    }

    public function all(): array {
        return $this->individualCast;
    }
}
