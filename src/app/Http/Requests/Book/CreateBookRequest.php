<?php

namespace App\Http\Requests\Book;

use App\Models\Heap;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateBookRequest extends FormRequest
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
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'max:255',
            ],
            'author' => [
                'required',
                'string',
                'max:255',
            ],
            'pages' => [
                'required',
                'integer',
            ],
            'heap_ids' => [
                'nullable',
                'array',
                'min:1',
                Rule::exists(Heap::class, 'id'),
            ],
            'heap_ids.*' => [
                'integer',
            ],
        ];
    }
}
