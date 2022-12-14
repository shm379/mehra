<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Product;
use App\Rules\AddToCartRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AddToCartRequest extends ApiFormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $min_purchases_per_user = 1;
        $max_purchases_per_user = 1;
        $product = Product::query()->find($this->request->get('id'));
        if($product) {
            $min_purchases_per_user = $product->min_purchases_per_user ?? $min_purchases_per_user;
            $max_purchases_per_user = $product->max_purchases_per_user ?? $max_purchases_per_user;
        }
        return [
            'quantity'=> [
                'required',
                'integer',
                'min:'.$min_purchases_per_user,
                'max:'.$max_purchases_per_user,
            ],
            'id'=>[
                'required',
                'exists:App\Models\Product,id',
//                new AddToCartRule()
            ],
            'extra_info'=>'nullable'
        ];
    }

    public function messages()
    {
        return [
          'quantity.max'=>'تعداد درخواستی شما برای خرید بیشتر از حد مجاز است!',
          'quantity.min'=>'تعداد درخواستی شما برای خرید کمتر از حد مجاز است!',
        ];
    }
}
