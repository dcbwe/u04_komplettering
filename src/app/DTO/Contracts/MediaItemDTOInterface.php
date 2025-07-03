<?php

namespace App\DTO\Contracts;

interface MediaItemDTOInterface {
    public function route(): string;
    public function imagePreview(): string;
    public function imageUrl(): string;
    public function released(): string;
}