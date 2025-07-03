<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CharsUsername implements ValidationRule {
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $value)) {
            $fail('Username must be 3–20 characters long and may only contain Aa-Zz, 0-9, and underscores.');
        }
    }
}