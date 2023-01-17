<?php

namespace App\Http\Controllers\Api\Global;

use App\Enums\ShippingType;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\Cart\SelectAddressRequest;
use App\Http\Requests\Api\RemoveFromCartRequest;
use App\Http\Requests\Api\Shipping\CalculateShippingRequest;
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
    public function __construct(ShippingService $shipping)
    {
        $this->shipping = $shipping;
    }

    public function calculate(CalculateShippingRequest $request)
    {
        $this->shipping->setType($request->validated('type'));
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


    /*
     * Set Address To Cart
     */
    public function setAddress(SelectAddressRequest $request)
    {
        $address_id = $request->validated('address_id');
        try {
            $this->shipping->selectAddress($address_id);
            $this->shipping->setType($request->validated('type'));

            return $this->successResponseWithData($this->shipping->calculateShipping());
        }
        catch (\Exception $exception){
            return $this->errorResponse('خطا در عملیات');
        }
    }
}
