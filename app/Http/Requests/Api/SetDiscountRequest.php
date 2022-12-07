<?php

namespace App\Http\Requests\Api;

use App\Models\Product;
use App\Rules\AddToCartRule;
use App\Rules\SetDiscountRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use \App\Models\Cart;
class SetDiscountRequest extends FormRequest
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
            'code'=> [
                'exists:App\Models\Discount,code',
                'required',
                new SetDiscountRule::class
            ],
        ];
    }

    public function messages()
    {
        return [
          'code.exists'=>'کد تخفیف مورد نظر وجود ندارد',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => count($validator->errors()->all())?$validator->errors()->all()[0]:$validator->errors()->all(),

//            'rules'      => $validator->failed()

        ]));

    }

}
