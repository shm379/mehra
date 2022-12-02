<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\RemoveFromCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use App\Services\CheckoutService;

class CheckoutController extends Controller {

    /*
     * Cart Service Inject
     */
    protected CheckoutService $checkout;
    public function __construct(CheckoutService $checkout)
    {
        $this->checkout = $checkout;
    }

    public function cartToCheckout(Cart $cart,)
    {

    }
}
