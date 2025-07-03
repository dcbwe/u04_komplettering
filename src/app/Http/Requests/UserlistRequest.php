<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CharsUsername;
use App\Rules\NameUserlist;

class UserlistRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'listname' => [
                'required',
                new CharsUsername,
                new NameUserlist,
            ],
        ];
    }

    public function messages(): array {
        return [
            'listname.required' => 'Please choose a username!',
            'listname.confirmed' => 'Passwords do not match.',
        ];
    }
}

