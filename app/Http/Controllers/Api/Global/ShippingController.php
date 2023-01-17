<?php

namespace App\Http\Controllers\Api\Global;

use App\Enums\ShippingType;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\RemoveFromCartRequest;
use App\Http\Resources\Api\CartResource;
use App\Models\Product;
use App\Models\City;
use App\Models\State;
use App\Services\CartService;
use App\Services\Shipping\TapinShipping;
use App\Services\ShippingService;

class ShippingController extends Controller {


    /*
     * Shipping Service Inject
     */
    protected ShippingService $shipping;
    public function __construct(ShippingService $shipping,$type=ShippingType::TAPIN)
    {
        $this->shipping = $shipping;
        $this->shipping->setType($type);
    }

    public function calculate()
    {
        return $this->successResponseWithData($this->shipping->calculateShipping());
    }
    /*
     * Get States
     */
    public function getStates()
    {
       return $this->successResponseWithData(State::query()->get());
    }

    /*
     * Get Cities By State
     */
    public function getCities(State $state)
    {
        return $this->successResponseWithData($state->cities()->get());
    }
}
