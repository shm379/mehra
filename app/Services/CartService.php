<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\ProductStructure;
use App\Models\Book;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Support\Facades\App;

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
/*        if($cart->doesntExist()){
            $this->createCart();
            $cart = User::GetCart($this->user_id);
            return $cart;
        }*/
        self::updateCart($cart);
        if($cart->exists())
            return $cart;

        return null;
    }

    public function cartExists()
    {
        $cart = $this->getCart();
        if($cart && $cart->exists())
            return true;

        return false;
    }
    public function getCartItems()
    {
        $cart = $this->getCart();
        if($cart && $cart->exists())
            return $cart->items;

        return [];
    }

    private function createCart()
    {
        try {
            return User::query()->find($this->user_id)->orders()->create([
                'user_id' => $this->user_id,
                'status' => OrderStatus::CART(),
                'total_price'=>0,
                'total_price_without_discount'=>0,
            ]);
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function findCartItemByProductID($product_id)
    {
        return $this->getCart()
            ->items()
            ->whereIn('line_item_type',ProductStructure::getKeys())
            ->where('line_item_id',$product_id)
            ->first();
    }

    private function getCartItem($item_type='book',$item_id,$quantity)
    {
        $model = '\\App\\Models\\' . ucfirst($item_type);
        $item = $model::query()->find($item_id);
        $cartItem = [];
        $cartItem['line_item_type'] = $item_type;
        $cartItem['line_item_id'] = $item_id;
        $cartItem['is_virtual'] = $item->is_virtual;
        $cartItem['price_without_discount'] = $item->price;
        $cartItem['price'] = $item->sale_price ?? $item->price;
        $cartItem['quantity'] = $quantity;
        $cartItem['total_price_without_discount'] = $quantity * $cartItem['price_without_discount'];
        $cartItem['total_price'] = $quantity * $cartItem['price'];


        return $cartItem;

    }

    private function calculateItem($item,$quantity=1,$op)
    {
        try {
            // if add to cart
            if($op=='+'){
                $item->quantity = $item->quantity  + $quantity;
            }
            // if remove from cart
            if($op=='-'){
                $item->quantity = $item->quantity - $quantity;
            }
            if ($item->quantity <= 0) {
                // IF Delete Item
                $item->delete();
            } else {
                self::updateItem($item);
            }
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

    public function addToCart($type='book',$id,$quantity=1,$is_virtual=0)
    {
        $cart = self::getCart();
        if(!$cart){
            $cart = self::createCart();
        }
        $cartItem = $cart->items()->firstOrCreate([
            'line_item_id'=>$id,
            'line_item_type'=> $type,
        ],self::getCartItem($type,$id,$quantity));

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
            $item = $cart->items()
                ->where([
                'line_item_id'=>$product_id,
                ])
                ->whereIn('line_item_type',ProductStructure::getKeys());
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
    public function selectAddress($address_id)
    {
        $cart = self::getCart();
        if($cart){
            $cart->update([
                'address_id' => $address_id
            ]);

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

    public function addShipping($shipping_id,$price)
    {
        $cart = self::getCart();
        if(!$cart){
            $cart = self::createCart();
        }
        $cartItem = $cart->items()->firstOrCreate([
            'line_item_id'=>$shipping_id,
            'line_item_type'=> 'shipping',
            'is_virtual'=> false,
            'price'=> $price,
            'total_price'=> $price,
            'quantity' => 1,

        ],self::getCartItem('shipping',$shipping_id,1));

        if(!$cartItem->wasRecentlyCreated){
            self::calculateItem($cartItem,1,'+');
        }

        return self::getCart();
    }
}
