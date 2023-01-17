<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Checkout\VerifyRequest;
use App\Http\Requests\Api\Checkout\CalculateShippingRequest;
use App\Services\CheckoutService;

class CheckoutController extends Controller {

    /*
     * Checkout Service Inject
     */
    protected CheckoutService $checkout;
    public function __construct(CheckoutService $checkout)
    {
        $this->checkout = $checkout;
    }

    public function cartToCheckout(CalculateShippingRequest $request)
    {
        return $this->checkout->pay();
    }

    public function verifyPayment(VerifyRequest $request)
    {
        return $this->checkout->verify($request->validated());
    }
}
