<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Book;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Discount;
use App\Models\User;

class CartService
{
    public $user_id;

    public function __construct($guard='sanctum')
    {
        $this->user_id = auth($guard)->id();
    }

    public function getCart()
    {
        $cart = User::GetCart($this->user_id);
        self::updateCart($cart);
        if($cart->exists())
            return $cart;
        return null;
    }

    private function createCart()
    {
        try {
            return User::query()->find($this->user_id)->orders()->create([
                'user_id' => $this->user_id,
                'status' => OrderStatus::CART,
                'total_price'=>0,
                'total_price_without_discount'=>0,
            ]);
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function findCartItemByProductID($product_id)
    {
        return OrderItem::query()
            ->where('line_item_type','product')
            ->where('line_item_id',$product_id)
            ->first();
    }

    private function getCartItem($item_id,$quantity,$item_type=Book::class)
    {
        $item = $item_type::query()->find($item_id);
        $cartItem = [];
        if($item_type==Book::class) {
            $cartItem['line_item_type'] = 'product';
            $cartItem['line_item_id'] = $item_id;
            $cartItem['price_without_discount'] = $item->price;
            $cartItem['price'] = $item->sale_price ?? $item->price;
            $cartItem['quantity'] = $quantity;
            $cartItem['total_price_without_discount'] = $quantity * $cartItem['price_without_discount'];
            $cartItem['total_price'] = $quantity * $cartItem['price'];
        }

        return $cartItem;

    }

    private function calculateItem($item,$quantity=1,$op)
    {
        try {
            // if add to cart
            if($op=='+'){
                $item->quantity = $item->quantity + $quantity;
            }
            // if remove from cart
            if($op=='-'){
                $item->quantity = $item->quantity - $quantity;
            }
            if($item->quantity!=0)
                self::updateItem($item);

            // IF Delete Item
            else
                $item->delete();
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
        return $item;
    }

    private function updateItem($item)
    {
        try {
            $item->total_price = $item->quantity * $item->price;
            $item->total_price_without_discount = $item->quantity * $item->price_without_discount;
            $item->save();
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
        return $item;
    }

    private function updateCart($cart)
    {
        try {
            $cart->total_price = $cart->items()->sum('total_price');
            $cart->total_price_without_discount = $cart->items()->sum('total_price_without_discount');
            $cart->save();
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
        return $cart;
    }

    public function addToCart($product_id,$quantity=1)
    {
        $cart = self::getCart();
        if(!$cart){
            $cart = self::createCart();
        }
        $cartItem = $cart->items()->firstOrCreate([
            'line_item_id'=>$product_id,
            'line_item_type'=> 'product'
        ],self::getCartItem($product_id,$quantity));

        if(!$cartItem->wasRecentlyCreated){
            self::calculateItem($cartItem,$quantity,'+');
        }
        return self::getCart();
    }

    public function removeFromCart($product_id,$quantity=1)
    {
        $cart = self::getCart();
        if($cart){
            //Get Current Cart Item
            $item = $cart->items()->where([
                'line_item_id'=>$product_id,
                'line_item_type'=>'product'
            ]);
            // IF Cart Exists
            if($item->exists()){
                $currentItem = $item->first();
                $currentItem = self::calculateItem($currentItem,$quantity,'-');
                if(!$currentItem){
                    $cart->delete();
                }
            }
        }

        return self::getCart();
    }

    public function getCartTotal()
    {
        return self::getCart()->total_price;
    }

    public function getSumQuantities()
    {
        return (int)self::getCart()->items()->sum('quantity');
    }
}
