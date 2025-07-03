<?php

namespace App\DTO\Nested;

class IndividualCreditSet {
    public function __construct(
        public readonly IndividualCastCollection $individualCast,
        public readonly IndividualCrewCollection $individualCrew
    ) {}

    public static function individualCredits(array $credits): self {
        return new self(
            IndividualCastCollection::fromArray($credits['cast'] ?? []),
            IndividualCrewCollection::fromArray($credits['crew'] ?? [])
        );
    }

}
