<?php

namespace App\Http\Requests\ProductVariant;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\ApiFormatter;

class ProductVariantValidationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required',
            'category_id'=> 'required',
            'variant_id' => 'required',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'status' => 'boolean|required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiFormatter::buildResponse(400,"BAD_REQUEST", null)
        );
    }
}
