<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Cart\AddToCartRequest;
use App\Http\Requests\Api\Cart\CheckoutRequest;
use App\Http\Requests\Api\Cart\RemoveFromCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\UserAddress;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use Tartan\Larapay\Facades\Larapay;

class CheckoutController extends Controller {

    /*
     * Cart Service Inject
     */
    protected CheckoutService $checkout;
    public function __construct(CheckoutService $checkout)
    {
        $this->checkout = $checkout;
    }

    public function cartToCheckout(CheckoutRequest $request)
    {
        $addressId = $this->checkout->saveAddress($request->except(['gateway']));
        $process = $this->checkout->process($addressId);
        if(!$process){
            return response()->json(['success'=>false,'message'=>'سبد خرید خالی است']);
        }
    }

    public function checkoutCallback(Request $request)
    {
        try{
            $adapterConfig = [];
            $transaction = Larapay::verifyTransaction($request, $adapterConfig);
            $order = $transaction->model;
            dd($order);
            //transaction done. payment is successful
        } catch (\Exception $e){
            // transaction not complete!!!
            // show error to your user
        }
    }
}
