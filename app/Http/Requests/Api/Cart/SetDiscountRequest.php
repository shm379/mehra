<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Product;
use App\Rules\AddToCartRule;
use App\Rules\SetDiscountRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use \App\Models\Cart;
class SetDiscountRequest extends ApiFormRequest
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
            'code'=> [
                'exists:App\Models\Discount,code',
                'required',
//                new SetDiscountRule::class
            ],
        ];
    }

    public function messages()
    {
        return [
          'code.exists'=>'کد تخفیف مورد نظر وجود ندارد',
        ];
    }


}
