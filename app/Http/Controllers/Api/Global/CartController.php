<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\RemoveFromCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Services\CartService;

class CartController extends Controller {

    protected CartService $cart;
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        if(!$this->cart->getCart(auth()->id())){
            return response()->json(['success'=>true,'items'=>[],'total_items'=>count([])]);
        }
        return new CartResource($this->cart->getCart(auth()->id()));
    }

    public function addItem(AddToCartRequest $request)
    {
        $product_id = $request->validated('id');
        $quantity = $request->validated('quantity');
        try {
            return new CartResource($this->cart->addToCart(auth()->id(),$product_id,$quantity));
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
    public function removeItem(RemoveFromCartRequest $request)
    {
        $product_id = $request->validated('id');
        $quantity = $request->validated('quantity');
        try {
            return $this->cart->removeFromCart(auth()->id(),$product_id,$quantity);
        }
        catch (\Exception $exception){

        }

        return response()->json(['success'=>true,'message'=>'Product ID REMOVE FROM CART']);
    }
}
