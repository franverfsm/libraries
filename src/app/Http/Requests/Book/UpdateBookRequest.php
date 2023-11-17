<?php

namespace App\Http\Requests\Book;

use App\Models\Heap;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

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
            'heap_ids' => [
                'nullable',
                'array',
                Rule::exists(Heap::class, 'id'),
            ],
            'heap_ids.*' => [
                'integer',
            ],
        ];
    }
}
