<?php

namespace App\Services;
use App\DTO\MovieDTO;

use Illuminate\Support\Collection;

class TrailerListService {
    protected string $sessionKey = 'trailer_window';

    public function rotate(Collection $trailers, ?string $direction = null): array {
        $window = session($this->sessionKey, $trailers);

        if (! $window instanceof Collection) {
            $window = collect($window);
        }

        match ($direction) {
            'forward'  => $window->push($window->shift()),
            'backward' => $window->prepend($window->pop()),
            default    => null,
        };

        session([$this->sessionKey => $window]);
        return $window->take(4)->all();
    }

    public function reset(Collection $trailers): void {
        session([$this->sessionKey => $trailers]);
    }

    /** @param MovieDTO[] $items */
    public function filterAndSort(array $items): array {
        return collect($items)
            ->filter(fn(MovieDTO $m) => $m->videos->trailerExist())
            ->sortByDesc(fn(MovieDTO $m) => $m->budget ?? 0)
            ->values()
            ->all();
    }
}
