<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\ApiFormatter;

class ProductValidationRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required|string|max:255"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiFormatter::buildResponse(400,"BAD_REQUEST", null)
        );
    }
}
