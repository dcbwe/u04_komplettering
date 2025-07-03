<?php

namespace App\ViewModels;

class VideoGalleryItemViewModel
{
    public function __construct(
        public readonly string $snapshot,
        public readonly string $url,
        public readonly string $title,
    ) {}
}
