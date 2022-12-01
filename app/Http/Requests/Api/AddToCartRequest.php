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
          'quantity.max'=>'تعداد نمی تواند بیششتر از :max عدد باشد'
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
