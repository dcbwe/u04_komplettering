<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Services\TrailerListService;
use Illuminate\Support\Collection;

class TrailerList extends Component {
    public array $window;

    public function __construct(
        public Collection $trailers,
        TrailerListService $list
    ) {
        $this->window = $list->rotate($trailers, request()->input('trailer_direction'));
    }

    public function render() {
        return view('components.trailer-list');
    }
}

