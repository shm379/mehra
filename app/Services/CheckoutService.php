<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class CheckoutService extends CartService
{
   public function __construct($guard = 'sanctum')
   {
       parent::__construct($guard);
   }

   public function toCheckout()
   {
        $cart = $this->getCart();
        dd($this->user_id);
   }
}
