<?php

namespace App\DTO\Nested;

class VideoDTO {
    public function __construct(
        public readonly string $key,
        public readonly int $size,
        public readonly string $site,
        public readonly string $type,
        public readonly string $name,
        public readonly bool $official,
    ) {}

    public function isYoutube(): bool {
        return strtolower($this->site) === 'youtube';
    }

    public function isHighRes(): bool {
        return strtolower($this->size) >= 720;
    }

    public function isOfficialTrailer(): bool {
        return str_contains(strtolower($this->name), 'official trailer');
    }

    public function isTrailer(): bool {
        return strtolower($this->type) === 'trailer';
    }

    public function isTeaser(): bool {
        return strtolower($this->type) === 'teaser';
    }

    public function youtubeTrailerUrl(): ?string {
        return $this->isYoutube() && $this->isTrailer() && $this->official 
            ? "https://www.youtube.com/watch?v={$this->key}" 
            : null;
    }

    public function youtubeTeaserUrl(): ?string {
        return $this->isYoutube() && $this->isTeaser() && $this->official 
            ? "https://www.youtube.com/watch?v={$this->key}" 
            : null;
    }

    public function isOfficialTrailerByName(): bool {
        return $this->isYoutube() &&
               str_contains(strtolower($this->name), 'official trailer');
    }

    public function youtubeUrl(): ?string {
        return "https://www.youtube.com/watch?v={$this->key}";
    }

    public function youtubeSnapshotUrlMax(): ?string {
        return match (true) {
            $this->isTrailer() && $this->isYoutube() && $this->official => "https://i.ytimg.com/vi_webp/{$this->key}/maxresdefault.webp",
            $this->isTeaser() && $this->isYoutube() && $this->official => "https://i.ytimg.com/vi_webp/{$this->key}/maxresdefault.webp",
            default => null,
        };
    }

    public function youtubeSnapshotUrlMaxName(): ?string {
        return match (true) {
            $this->isTrailer() && $this->isYoutube() && $this->official => $this->name,
            $this->isTeaser() && $this->isYoutube() && $this->official => $this->name,
            default => null,
        };
    }

    public function youtubeSnapshotUrl(): ?string {
        return "https://i.ytimg.com/vi_webp/{$this->key}/hqdefault.webp";
    }

    public function youtubeSnapshotUrlAll(): ?string {
        return match (true) {
            $this->isYoutube() && $this->isHighRes() => "https://i.ytimg.com/vi_webp/{$this->key}/hqdefault.webp",
            default => null,
        };
    }
    
    
    
}