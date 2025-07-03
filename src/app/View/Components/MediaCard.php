<?php

namespace App\View\Components;

use App\DTO\Contracts\MediaItemDTOInterface;
use Illuminate\View\Component;

class MediaCard extends Component {
    public MediaItemDTOInterface $item;

    public function __construct(MediaItemDTOInterface $item) {
        $this->item = $item;
    }

    public function render() {
        return view('components.media-card');
    }
}
