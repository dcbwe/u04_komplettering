<?php

namespace App\DTO\Nested;

class VideoCollection {
    /** @var VideoDTO[] */
    public function __construct(public readonly array $videos) {}

    public static function fromArray(array $items): self {
        return new self(array_map(fn($video) => new VideoDTO(
            $video['key'],
            $video['size'],
            $video['site'],
            $video['type'],
            $video['name'],
            $video['official']
        ), $items));
    }

    public function trailerExist(): bool {
        return $this->trailerUrl() !== null;
    }

    public function trailerUrl(): ?string {
        return $this->bestYoutubeVideo()?->youtubeUrl();
    }

    public function snapMaxRes(): ?string {
        return $this->bestYoutubeVideo()?->youtubeSnapshotUrlMax();
    }

    public function snapHighRes(): ?string {
        return $this->randomYoutubeVideo()?->youtubeSnapshotUrl();
    }

    public function trailerKey(): ?string {
        return $this->bestYoutubeVideo()?->key;
    } 
    
    private function bestYoutubeVideo(): ?VideoDTO {
        return collect($this->videos)
            ->filter(fn(VideoDTO $v) =>
                $v->isYoutube() && $v->official
            )
            ->sortByDesc(fn(VideoDTO $v) =>
                $this->scoreVideo($v)
            )
            ->first();
    }

    private function randomYoutubeVideo(): ?VideoDTO {
        return ($filtered = collect($this->videos)
            ->filter(fn(VideoDTO $v) => $v->isYoutube() && $v->official && $v->isHighRes())
            )->isNotEmpty() ? $filtered->random() : null;
    }

    private function scoreVideo(VideoDTO $v): int {
        return collect([
            str_contains(strtolower($v->type), 'trailer') ? 100 : 50,
            str_contains(strtolower($v->name), 'official') ? 20 : 0,
            str_contains(strtolower($v->name), 'trailer') ? 10 : 0,
            str_contains(strtolower($v->name), 'teaser') ? 5 : 0,
        ])->sum();
    }
}