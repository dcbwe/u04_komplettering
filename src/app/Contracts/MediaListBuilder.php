<?php

namespace App\Contracts;

interface MediaListBuilder {
    public function build(string $key): array;
}