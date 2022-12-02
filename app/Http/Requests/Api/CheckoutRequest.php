<?php

namespace App\Http\Requests\Api;

use App\Models\Product;
use App\Rules\AddToCartRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'first_name'=> 'required',
            'last_name'=> 'required',
            'province_id'=> 'required',
            'number'=> 'required',
            'postal_code'=> 'required',
            'unit'=> 'required',
            'district'=> 'required',
            'phone'=>'nullable',
            'mobile'=> 'nullable'
        ];
    }

    public function messages()
    {
        return [
//          'quantity.max'=>'تعداد درخواستی شما برای خرید بیشتر از حد مجاز است!',
//          'quantity.min'=>'تعداد درخواستی شما برای خرید کمتر از حد مجاز است!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => count($validator->errors()->all())?$validator->errors()->all()[0]:$validator->errors()->all(),

            'rules'      => $validator->failed()

        ]));

    }
}
