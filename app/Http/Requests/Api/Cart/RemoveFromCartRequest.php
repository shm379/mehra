<?php

namespace App\Http\Requests\Api\Cart;

use App\Enums\OrderStatus;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RemoveFromCartRequest extends ApiFormRequest
{
    protected $stopOnFirstFailure = true;
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
}
