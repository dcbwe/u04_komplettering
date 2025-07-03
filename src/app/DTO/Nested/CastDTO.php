<?php

namespace App\DTO\Nested;

class CastDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $character,
        public readonly string $profilePath,
        public readonly int $order,
    ) {}

    public function route(): string {
        return route('media.person', ['id' => $this->id]);
    }
    
    public function imagePreview(): string {
        return $this->profilePath
            ? "https://image.tmdb.org/t/p/w470_and_h470_face{$this->profilePath}"
            : asset('person-preview.svg');
    }
}
