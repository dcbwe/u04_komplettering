<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'question' => [
                'required',
                'string',
                'min:1',
                'max:500',
                'not_regex:/<[^>]*>/',
            ],
        ];
    }

    public function messages(): array {
        return [
            'question.required' => 'You need to ask something!',
            'question.not_regex' => 'Please write your question in a standard way without special chars!',
            'question.max' => 'Max-limit is 500 chars (not suggested to increase unless having Nvidia driver support)',
        ];
    }
}
