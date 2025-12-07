<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

  
    public function rules(): array
    {
        return [
            'message' => [
                'required',
                'string',
                'max:1000',
                'regex:/^[a-zA-Z0-9\s\.\,\?\!\-\_\(\)]+$/u', 
            ],
            'history' => 'nullable|array|max:10', 
            'history.*.role' => 'nullable|string|in:user,assistant',
            'history.*.content' => 'nullable|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'message.regex' => 'Pesan mengandung karakter yang tidak diizinkan.',
        ];
    }
}