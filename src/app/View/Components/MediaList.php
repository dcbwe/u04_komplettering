<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MediaList extends Component {
    public string $title;
    public string $subtitle;
    public array $items;

    public function __construct(string $title, string $subtitle, array $items) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->items = $items;
    }

    public function render(): View {
        return view('components.media-list');
    }
}
