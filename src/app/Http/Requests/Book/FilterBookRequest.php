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
                'sometimes',
                'string',
                'max:255',
            ],
            'description' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'author' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'pages' => [
                'sometimes',
                'integer',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
