<?php

namespace App\DTO;

use App\DTO\Nested\IndividualCreditSet;

class PersonDTO extends MediaItemDTO {
    public function __construct(
        int $id,
        bool $adult,
        string $name,
        ?string $profilePath,
        public readonly string $biography,
        public readonly string $knownForDepartment,
        public readonly IndividualCreditSet $credits,
        public readonly ?string $birthday,
        public readonly ?string $placeOfBirth,
        public readonly ?string $deathday,
    ) {
        parent::__construct($id, $adult, $name, $profilePath, $birthday, $biography);
    }

    public function type(): string {
        return 'person';
    }

    public function isDead(): string {
        return $this->deathday
            ? "-".substr($this->deathday, 0, 4)
            : '';
    }

    public function imagePreview(): string {
        return $this->image
            ? "https://image.tmdb.org/t/p/w470_and_h470_face{$this->image}"
            : asset('person-preview.svg');
    }

    public function imageUrl(): string {
        return $this->image
            ? "https://image.tmdb.org/t/p/original{$this->image}"
            : asset('person.svg');
    }
}