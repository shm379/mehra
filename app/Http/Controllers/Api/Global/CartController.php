<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Models\Product;
use Jackiedo\Cart\Cart;

class CartController extends Controller {

    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->cart->name('cart')->useForCommercial(true)->hasNoTaxes();
    }

    public function content()
    {
        return $this->cart->getDetails();
    }

    public function addItem(AddToCartRequest $request)
    {
        $product_id = $request->validated('id');
        $quantity = $request->validated('quantity');
        try {
            $product = Product::query()->find($product_id);
            $this->cart->addItem([
                'id'       => $product_id,
                'title'    => $product->title,
                'quantity' => $quantity,
                'price'    => isset($product->sale_price) ? $product->sale_price*$quantity : $product->price*$quantity,
            ]);
            return $this->cart->getItems();
        }
        catch (\Exception $exception){

        }

        return response()->json(['message'=>'Product ID ADD TO CART'], 201);
    }
}
