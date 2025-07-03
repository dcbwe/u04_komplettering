<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueUsername implements ValidationRule {
    protected array $reserved = [
        'admin', 'system', 'root', 'support', 'api',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $username = strtolower($value);

        if (
            in_array($username, $this->reserved) ||
            DB::table('users')->whereRaw('LOWER(username) = ?', [$username])->exists()
        ) {
            $fail("The username '{$value}' is already in use, please choose another.");
        }
    }
}