<?php

namespace App\Http\Requests\Api\Checkout;

use App\Enums\ProductStructure;
use App\Enums\ProductType;
use App\Helpers\Helpers;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PayRequest extends ApiFormRequest
{
    protected $stopOnFirstFailure = true;

    public array $rules = [];
    public $cart;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return $this->rules;
    }

    public function messages()
    {
        return [

        ];
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation(); // TODO: Change the autogenerated stub
        $this->cart = (new CartService())->getCart();
        if($this->cart->exists()){
            foreach ($this->cart->items as $item){
                if($item->line_item->type==ProductType::PRINTED_BOOK || $item->line_item->type==ProductType::CD){
                    if(is_null($this->cart->address_id)) {
                        throw ValidationException::withMessages(['address_not_selected' => 'لطفا آدرس را انتخاب کنید']);
                    }
                }
            }
        }
        else {
            throw ValidationException::withMessages(['cart_is_empty' => 'سبد خرید شما خالی است!']);
        }
    }

    protected function passedValidation()
    {
//        if($this->cart && $this->cart->exists() && $this->request->has('address_id'))
//        {
//            $this->cart->update(['address_id' =>$this->request->get('address_id')]);
//        }
    }
}
