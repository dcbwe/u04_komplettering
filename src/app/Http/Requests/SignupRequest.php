<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CharsUsername;
use App\Rules\UniqueUsername;
use App\Rules\StrongPassword;

class SignupRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'username' => [
                'required',
                new CharsUsername,
                new UniqueUsername,
            ],
            'password' => [
                'required',
                new StrongPassword(8,30,2),
                'confirmed',
            ],
        ];
    }

    public function messages(): array {
        return [
            'username.required' => 'Please choose a username!',
            'password.confirmed' => 'Passwords do not match.',
        ];
    }
}

