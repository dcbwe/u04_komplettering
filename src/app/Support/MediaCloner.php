<?php

namespace App\Support;

use App\DTO\MediaItemDTO;

class MediaCloner {
    public function apply(MediaItemDTO $item, ?float $avg, ?int $user): MediaItemDTO {
        $clone = clone $item;

        foreach (['internalScore' => $avg, 'userScore' => $user] as $property => $value) {
            $ref = new \ReflectionProperty($clone, $property);
            $ref->setAccessible(true);
            $ref->setValue($clone, $value);
        }
        return $clone;
    }
}
