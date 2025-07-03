<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBar extends Component {
    public string $query;
    public string $type;

    public function __construct(string $query = '', string $type = 'multi') {
        $this->query = $query;
        $this->type = $type;
    }

    public function render() {
        return view('components.search-bar');
    }
}

