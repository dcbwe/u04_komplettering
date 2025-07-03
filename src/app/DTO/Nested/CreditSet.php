<?php

namespace App\DTO\Nested;

class CreditSet {
    public function __construct(
        public readonly CastCollection $cast,
        public readonly CrewCollection $crew,
    ) {}

    public static function fromCredits(array $credits): self {
        return new self(
            CastCollection::fromArray($credits['cast'] ?? []),
            CrewCollection::fromArray($credits['crew'] ?? [])
        );
    }

    /** @return CrewDTO[] */
    public function directors(): array {
        return $this->crew->filterByJob('Director');
    }

    /** @return CrewDTO[] */
    public function producers(): array {
        return $this->crew->filterByJob('Producer');
    }

    /** @return CrewDTO[] */
    public function writers(): array {
        return $this->crew->filterByDepartment('Writing');
    }
}
