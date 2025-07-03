<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class NameUserlist implements ValidationRule {
    protected array $reserved = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $listName = strtolower($value);
        $config = config('tmdb.media_list_factory', []);

        if (
            in_array($listName, array_merge($this->reserved, $config)) ||
            DB::table('interaction')->whereRaw('LOWER(list_type) = ?', [$listName])->exists()
        ) {
            $fail("Please pick another name for your list");
        }
    }
}