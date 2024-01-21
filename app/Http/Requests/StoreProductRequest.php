<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;


class StoreProductRequest extends BaseFormRequest
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
            'name' => ['required', 'string', 'max:100', Rule::unique(table: 'products', column: 'name'),],
            'price' => ['required', 'decimal:0,2',],
            'brand_id' => ['nullable', 'integer', Rule::exists(table: 'brands', column: 'id'),],
            'stock' => ['nullable', 'decimal:0,2',],
            'city_id' => ['required', 'integer', Rule::exists(table: 'cities', column: 'id'),],
        ];
    }
}
