<?php

namespace App\Http\Requests\Heap;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class CreateHeapRequest extends FormRequest
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
                'required',
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
        ];
    }
}
