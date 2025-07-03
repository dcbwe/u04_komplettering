<?php

namespace App\DTO;

use App\ViewModels\VideoGalleryViewModel;
use App\DTO\Nested\{CompanyCollection, CreditSet,GenreCollection,VideoCollection};

class MovieDTO extends MediaItemDTO {
    public function __construct(
        int $id,
        bool $adult,
        string $title,
        ?string $posterPath,
        public readonly string $overview,
        public readonly string $releaseDate,
        public readonly float $revenue,
        public readonly float $budget,
        public readonly GenreCollection $genres,
        public readonly int $runtime,
        public readonly string $tagline,
        public readonly CompanyCollection $companies,
        public readonly CreditSet $credits,
        public readonly VideoCollection $videos,
    ) {
        parent::__construct($id, $adult, $title, $posterPath, $releaseDate, $overview);
    }

    public function type(): string {
        return 'movie';
    }

    public function imagePreview(): string {
        return $this->image
            ? "https://image.tmdb.org/t/p/w342{$this->image}"
            : asset('favicon.svg');
    }

    public function imageUrl(): string {
        return $this->image
            ? "https://image.tmdb.org/t/p/original{$this->image}"
            : asset('favicon.svg');
    }

    public function genreNames(): array {
        return array_map(fn($genre) => $genre->name, $this->genres->genres);
    }

    public function toVideoGallery(): VideoGalleryViewModel {
        return new VideoGalleryViewModel($this->videos);
    }
}