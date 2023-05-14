<?php

namespace App\Http\Requests\Api\Cart;

use App\Enums\OrderStatus;
use App\Enums\ProductStructure;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
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
        $item = null;
        $quantity = 1;
        // check cart quantity item
        $cart = (new CartService);
        if($cart->getCart()!==null && $cart->getCart()->exists()){
            $item = $cart->findCartItemByProductID($this->request->get('id'));
            if($item)
                $quantity = $item->quantity;
        }

        return [
            'id'=>[
                'required',
                Rule::exists('order_items','line_item_id')
                    ->where('order_id',$cart->getCart()->id)
            ],
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
