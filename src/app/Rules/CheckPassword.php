<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckPassword implements ValidationRule {
    protected int $minChars;
    protected int $maxChars;

    public function __construct(int $minChars, int $maxChars) {
        $this->minChars = $minChars;
        $this->maxChars = $maxChars;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (is_string($value)) {
            $length = mb_strlen($value);
            if ($length >= $this->minChars && $length <= $this->maxChars) {
                return;
            }
        }
        $fail("Incorrect, please try again!");
    }
}
