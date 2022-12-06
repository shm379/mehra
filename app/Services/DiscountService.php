<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Discount;
use App\Models\User;

class DiscountService extends CartService
{
    public function applyDiscount($code)
    {
        $cart = self::getCart();
        if($cart){
            $discount = self::getDiscount($code);
            if(!$discount) {
                return false;
            }
        }

        return true;
    }

    private function getDiscount($code)
    {
        return Discount::query()
            ->where('code',$code)
            ->whereNull('expire_at')
            ->orWhere('expire_at','>=', now())
            ->first();
    }
}
