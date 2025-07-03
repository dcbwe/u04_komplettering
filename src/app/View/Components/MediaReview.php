<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\DTO\Nested\ReviewCollection;

class MediaReview extends Component {
    public function __construct(public ReviewCollection $reviews) {}

    public function render() {
        return view('components.media-review');
    }
}
