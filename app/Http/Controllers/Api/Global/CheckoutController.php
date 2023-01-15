<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Checkout\VerifyRequest;
use App\Http\Requests\Api\Checkout\PayRequest;
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

    public function cartToCheckout(PayRequest $request)
    {
        $addressId = $this->checkout->saveAddress($request->validated());
        return $this->checkout->pay($addressId);
    }

    public function verifyPayment(VerifyRequest $request)
    {
        return $this->checkout->verify($request->validated());
    }
}
