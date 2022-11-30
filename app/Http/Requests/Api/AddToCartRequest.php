<?php

namespace App\Http\Requests\Api;

use App\Models\Product;
use App\Rules\AddToCartRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'=>[
                'required',
                'exists:App\Models\Product,id',
                new AddToCartRule()
            ],
            'quantity'=>'required',
            'extra_info'=>'nullable'
        ];
    }

    protected function prepareForValidation()
    {

    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'خطا',

            'data'      => $validator->errors()

        ]));

    }
}
