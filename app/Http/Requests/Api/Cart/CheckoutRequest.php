<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Product;
use App\Rules\AddToCartRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CheckoutRequest extends ApiFormRequest
{
    protected $stopOnFirstFailure = true;

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
            'state_id'=> 'required',
            'number'=> 'required',
            'postal_code'=> 'required',
            'unit'=> 'required',
            'district'=> 'required',
            'phone'=>'required',
            'mobile'=> 'required',
            'gateway'=> 'required'
        ];
    }

    public function messages()
    {
        return [
//          'quantity.max'=>'تعداد درخواستی شما برای خرید بیشتر از حد مجاز است!',
//          'quantity.min'=>'تعداد درخواستی شما برای خرید کمتر از حد مجاز است!',
        ];
    }
}
