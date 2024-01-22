<?php

namespace App\Http\Requests;

use App\Http\Responses\ApiErrorResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class BaseFormRequest extends FormRequest
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = (new ApiErrorResponse(
            message: trans(key: 'validation.invalid_data'),
            data: $validator->errors()->toArray()
        ))->toResponse();
        throw new HttpResponseException($response);
    }
}
