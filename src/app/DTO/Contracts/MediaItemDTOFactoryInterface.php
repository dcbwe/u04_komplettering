<?php

namespace App\DTO\Contracts;

use App\DTO\MediaItemDTO;

interface MediaItemDTOFactoryInterface {
    public function mapItem(array $data): MediaItemDTO;
}
