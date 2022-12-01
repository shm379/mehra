<?php

namespace App\Http\Requests\Api;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RemoveFromCartRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $quantity = 1;
        // check cart quantity item
        $cart = auth()->user()->orders()->where('status',OrderStatus::CART);
        if($cart->exists()){
            $item = $cart->first()->items()->where('line_item_id',$this->request->get('id'));
            if($item->exists())
                $quantity = $item->first()->quantity;
        }

        return [
            'id'=>'required|exists:App\Models\OrderItem,line_item_id',
            'quantity'=> [
                'required',
                'integer',
                'max:'.$quantity
            ],
        ];
    }

    public function messages()
    {
        return [
          'id.exists'=>'آیتم انتخابی در سبد خرید وجود ندارد'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => count($validator->errors()->all())?$validator->errors()->all()[0]:$validator->errors()->all(),

            'data'      => $validator->failed()

        ]));

    }
}
