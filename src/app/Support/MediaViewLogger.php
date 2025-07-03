<?php

namespace App\Support;

use App\DTO\MediaItemDTO;
use App\Models\MediaView;

class MediaViewLogger {

    public function log(MediaItemDTO $item): void {
        MediaView::create([
            'user_id' => auth()->id(),
            'media_id' => $item->id,
            'media_type' => $item->type(),
            'adult' => $item->adult,
            'viewed_at' => now(),
        ]);
    }
}
