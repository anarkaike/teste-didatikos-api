<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;


class UpdateBrandRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:100',],
            'manufacturer' => ['nullable', 'string', 'max:255',],
        ];
    }
}
