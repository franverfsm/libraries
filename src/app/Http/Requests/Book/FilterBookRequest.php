<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'author' => [
                'nullable',
                'string',
                'max:255',
            ],
            'pages' => [
                'nullable',
                'integer',
            ],
            'heap_id' => [
                'nullable',
                'array',
            ],
            'heap_id.*' => [
                'integer',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
