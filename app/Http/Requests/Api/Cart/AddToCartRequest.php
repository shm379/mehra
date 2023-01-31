<?php

namespace App\Http\Requests\Api\Cart;

use App\Enums\ProductStructure;
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
    protected $product;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $min_purchases_per_user = 1;
        $max_purchases_per_user = 1;
        $this->product = Product::query()->find($this->request->get('id'));
        return [
            'quantity'=> [
                'required',
                'integer',
                //check min in checkout
                'min:'.$min_purchases_per_user,
                function ($attribute, $value, $fail) {
                    $product = $this->product;
                    $quantity = $value;
                    if($quantity==1 && $product->max_purchases_per_user <= 0)
                        $fail('تعداد درخواستی شما برای خرید بیشتر از حد مجاز است!');
                    elseif($quantity>1 && $product->max_purchases_per_user - ($quantity) < 0)
                        $fail(
                            'تعداد درخواستی شما برای خرید بیشتر از حد مجاز است!' .
                            ($product->max_purchases_per_user!=0 ?
                                ' - تعداد مجاز:' . $product->max_purchases_per_user : '')
                        );
                },
            ],
            'id'=>[
                'required',
                'exists:App\Models\Product,id',
//                new AddToCartRule()
            ],
            'extra_info'=>'nullable',
            'is_virtual'=>'nullable',
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'is_virtual' => (bool)$this->product->is_virtual
        ]);
    }

    public function messages()
    {
        return [
          'quantity.max'=>'تعداد درخواستی شما برای خرید بیشتر از حد مجاز است!',
          'quantity.min'=>'تعداد درخواستی شما برای خرید کمتر از حد مجاز است!',
        ];
    }
}
