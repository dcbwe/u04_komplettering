<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    protected int $minChars;
    protected int $maxChars;
    protected int $minSpecial;

    public function __construct(int $minChars, int $maxChars, int $minSpecial)
    {
        $this->minChars = $minChars;
        $this->maxChars = $maxChars;
        $this->minSpecial = $minSpecial;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $length = strlen($value);
        $uppercase = preg_match('/[A-Z]/', $value);
        $special = preg_match_all('/[\d\W]/', $value);

        if (
            $length < $this->minChars ||
            $length > $this->maxChars ||
            !$uppercase ||
            $special < $this->minSpecial
        ) {
            $fail("Password must have one uppercase and between
                {$this->minChars}-
                {$this->maxChars} characters and atleast
                {$this->minSpecial} special characters 
            ");
        }
    }
}
