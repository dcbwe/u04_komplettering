<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchResults extends Component {
    public array $results;

    public function __construct(array $results = []) {
        $this->results = $results;
    }

    public function render() {
        return view('components.search-results');
    }
}
