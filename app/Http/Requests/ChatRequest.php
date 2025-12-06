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
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array',
            'history.*.role' => 'nullable|string|in:user,assistant',
            'history.*.content' => 'nullable|string',
        ];
    }

  
    public function messages(): array
    {
        return [
            'message.required' => 'Pesan tidak boleh kosong',
            'message.max' => 'Pesan terlalu panjang (maksimal 1000 karakter)',
            'history.array' => 'Format riwayat chat tidak valid',
        ];
    }
}