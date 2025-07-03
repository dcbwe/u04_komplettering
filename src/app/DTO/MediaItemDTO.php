<?php

namespace App\DTO;

use App\DTO\Contracts\MediaItemDTOInterface;

abstract class MediaItemDTO implements MediaItemDTOInterface {
    public function __construct(
        public readonly int $id,
        public readonly bool $adult,
        public readonly string $title,
        public readonly ?string $image,
        public readonly ?string $released,
        public readonly ?string $info,
        protected ?float $internalScore = null,
        protected ?int $userScore = null,
    ) {}

    public function route(): string {
        return route("media.{$this->type()}", $this->id);
    }

    public function route1(): string {
        return route("media.{$this->type()}");
    }

    public function isAdult(): string {
        return $this->adult ? '1' : '0';
    }

    public function released(): string {
        return substr($this->released, 0, 4);
    }

    public function score(): ?float {
        return $this->internalScore;
    }

    public function scoreFormated(): string {
        return number_format($this->internalScore, 1);
    }

    public function userScore(): ?int {
        return $this->userScore;
    }

    public function userScoreFormated(): string {
        return $this->userScore !== null
            ? "{$this->userScore}"
            : '-'
            ;
    }

    abstract public function type(): string;
}