<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Product;
use App\Models\User;

class CartService
{
    public function getCart($user_id)
    {
        $cart = User::GetCart($user_id);
        self::updateCart($cart);
        if($cart->exists())
            return $cart;
        return null;
    }

    private function createCart($user_id) : \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|bool
    {
        try {
            return User::query()->find($user_id)->orders()->create([
                'user_id' => $user_id,
                'status' => OrderStatus::CART,
                'total_price'=>0,
                'total_price_without_discount'=>0,
            ]);
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    private function getItem($item_id,$item_type): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|bool
    {
        $item = $item_type::query()->find($item_id);
        $product = [];
        if($item_type==Product::class) {
            $product['line_item_type'] = 'product';
            $product['line_item_id'] = $item_id;
            $product['price_without_discount'] = $item->price;
            $product['price'] = $item->sale_price ?? $item->price;
        }
        return $product;

    }

    private function calculateTotal($item,$quantity=1): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|bool
    {
        $item['quantity'] = $quantity;
        $item['total_price_without_discount'] = $quantity * $item['price_without_discount'];
        $item['total_price'] = $quantity * $item['price'];
        return $item;

    }

    private function calculateCart($product_id,$quantity): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|bool
    {
        $item = self::getItem($product_id,Product::class);
        return self::calculateTotal($item,$quantity);

    }
    private function updateCart($cart): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|bool
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

    public function addToCart($user_id,$product_id,$quantity=1)
    {
        $cart = self::getCart($user_id);
        if(!$cart){
            $cart = self::createCart($user_id);
        }
        $cartItem = $cart->items()->firstOrCreate([
            'order_id'=>$cart->id,
            'line_item_id'=>$product_id,
            'line_item_type'=>'product'
        ],self::calculateCart($product_id,$quantity));

        if(!$cartItem->wasRecentlyCreated){
            $quantity = $cartItem->quantity+$quantity;
            $cartItem->quantity = $quantity;
            $cartItem->total_price = $cartItem->price * $quantity;
            $cartItem->total_price_without_discount = $cartItem->price_without_discount * $quantity;
            $cartItem->save();
        }
        return $cart;
    }

    public function removeFromCart($user_id,$product_id,$quantity)
    {
        $cart = self::getCart($user_id);
        if($cart){
            $cart->items()->firstOrDelete(self::calculateCart($product_id,$quantity));
        }

        return $cart;
    }
}
