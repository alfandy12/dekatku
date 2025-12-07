<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => ['required', 'string', 'min:2', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'q.required' => 'Query pencarian tidak boleh kosong',
            'q.min' => 'Query pencarian minimal 2 karakter',
            'q.max' => 'Query pencarian maksimal 100 karakter',
        ];
    }

    public function getQuery(): string
    {
        return $this->validated()['q'];
    }
}