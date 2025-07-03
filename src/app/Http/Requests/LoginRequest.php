<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CharsUsername;
use App\Rules\CheckPassword;

class LoginRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'username' => ['required', new CharsUsername],
            'password' => ['required', new CheckPassword(8,30)],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required!',
            'password.required' => 'Password is required!',
        ];
    }
}
