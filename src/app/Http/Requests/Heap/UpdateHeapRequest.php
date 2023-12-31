<?php

namespace App\Http\Requests\Heap;

use App\Models\Book;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateHeapRequest extends FormRequest
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
            'name' => [
                'sometimes',
                'string',
                'max:128',
            ],
            'cep' => [
                'nullable',
                'integer',
                'digits:8',
                'min:00000000',
                'max:99999999',
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'number' => [
                'nullable',
                'integer',
            ],
            'bourg' => [
                'nullable',
                'string',
                'max:128',
            ],
            'city' => [
                'nullable',
                'string',
                'max:255',
            ],
            'state' => [
                'nullable',
                'string',
                'max:255',
            ],
            'book_ids' => [
                'nullable',
                'array',
                Rule::exists(Book::class, 'id'),
            ],
            'book_ids.*' => [
                'integer',
            ],
        ];
    }
}
