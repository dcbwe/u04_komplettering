<?php

namespace App\DTO;

use App\DTO\Nested\{CompanyCollection, CreditSet,GenreCollection,VideoCollection};

class TvShowDTO extends MediaItemDTO {
    public function __construct(
        int $id,
        bool $adult,
        string $name,
        ?string $posterPath,
        public readonly string $overview,
        public readonly GenreCollection $genres,
        public readonly string $firstAirDate,
        public readonly string $tagline,
        public readonly int $numberOfSeasons,
        public readonly int $numberOfEpisodes,
        public readonly CompanyCollection $companies,
        public readonly CreditSet $credits,
        public readonly VideoCollection $videos,
    ) {
        parent::__construct($id, $adult, $name, $posterPath, $firstAirDate, $overview);
    }

    public function type(): string {
        return 'tv';
    }

    public function imagePreview(): string {
        return $this->image
            ? "https://image.tmdb.org/t/p/w342{$this->image}"
            : asset('tv.svg');
    }

    public function imageUrl(): string {
        return $this->image
            ? "https://image.tmdb.org/t/p/original{$this->image}"
            : asset('tv.svg');
    }

    public function genreNames(): array {
        return array_map(fn($genre) => $genre->name, $this->genres->genres);
    }
}