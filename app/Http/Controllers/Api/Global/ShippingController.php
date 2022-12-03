<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\RemoveFromCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\ShippingCity;
use App\Models\ShippingState;
use App\Services\CartService;

class ShippingController extends Controller {


    /*
     * Get States
     */
    public function getStates()
    {
       return ShippingState::query()->get();
    }

    /*
     * Get Cities By State
     */
    public function getCities(ShippingState $state)
    {
        return $state->cities()->get();
    }
}
