<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Model;
use Tartan\Larapay\Models\Enum\Bank;

class CheckoutService extends CartService
{
   public function __construct($guard = 'sanctum')
   {
       parent::__construct($guard);
   }

    public function saveAddress($addressData)
    {
        try {
            $addressData['user_id'] = $this->user_id;
            return UserAddress::query()->create($addressData);
        } catch (\Exception $exception){
            dd($exception->getMessage());
            return null;
        }
    }

   public function process($userAddressId)
   {
        $cart = $this->getCart();
        if($cart->total_price!==0) {
//            $transaction = $cart->createTransaction(Bank::ZARINPAL, $cart->total_price);
//            $form = $transaction->generateForm();
//            dd($form);

//            return view('go-to-bank', [
//                'form' => $form,
//            ]);
            return true;
        }
        return false;
   }
}
