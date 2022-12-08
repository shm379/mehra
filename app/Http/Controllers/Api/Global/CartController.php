<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\RemoveFromCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Services\CartService;

class CartController extends Controller {

    /*
     * Cart Service Inject
     */
    protected CartService $cart;
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    /*
     * Get Cart From Cart Service With Cart Resource
     */
    public function getCart()
    {
        if(!$this->cart->getCart()){
            return response()->json(['success'=>true,'data'=>['items'=>[],'total_items'=>count([])]]);
        }
        return new CartResource($this->cart->getCart());
    }

    /*
     * Add Item To Cart With Cart Service
     * @response CartResource $cart
     */
    public function addItem(AddToCartRequest $request)
    {
        $product_id = $request->validated('id');
        $quantity = $request->validated('quantity');
        try {
            return new CartResource($this->cart->addToCart($product_id,$quantity));
        }
        catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>config('app.debug')? $exception->getMessage() :'خطا در عملیات']);
        }
    }

    /*
     * Remove Item From Cart With Cart Service
     * @response CartResource $cart
     */
    public function removeItem(RemoveFromCartRequest $request)
    {
        $product_id = $request->validated('id');
        $quantity = $request->validated('quantity');
        try {
            return new CartResource($this->cart->removeFromCart($product_id,$quantity));
        }
        catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>config('app.debug')? $exception->getMessage() :'خطا در عملیات']);
        }
    }
}
