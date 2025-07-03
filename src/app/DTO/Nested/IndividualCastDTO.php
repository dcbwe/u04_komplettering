<?php
namespace App\DTO\Nested;

class IndividualCastDTO {
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $character,
        public readonly ?string $posterPath,
        public readonly string $releaseDate,
        public readonly int $order,
        public readonly string $mediaType,
    ) {}

    public function route(): string {
        return route("media.{$this->mediaType}", ['id' => $this->id]);
    }

    public function released(): string {
        return substr($this->releaseDate, 0, 4);
    }

    public function imageUrl(): string {
        return match($this->mediaType) {
            'movie' => $this->posterPath
                ? "https://image.tmdb.org/t/p/w185{$this->posterPath}"
                : asset('favicon.svg'),
            'tv' => $this->posterPath
                ? "https://image.tmdb.org/t/p/w185{$this->posterPath}"
                : asset('tv.svg'),
            'person' => $this->posterPath
                ? "https://image.tmdb.org/t/p/w185{$this->posterPath}"
                : asset('person.svg'),
        };
    }
}
