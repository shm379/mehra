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
    public $cart = null;

    protected function applyDiscountToCart($cart, $discountService, $discountCode)
    {
        // اعمال تخفیف به سبد خرید

        $discountService->applyDiscount($discountCode); // فراخوانی تابع applyDiscount از کلاس DiscountService
    }

    public function __construct($guard='sanctum')
    {
        $this->user_id = auth($guard)->id();
    }

    public function getCart($withoutShipping=true)
    {
        $cart = User::GetCart($this->user_id,$withoutShipping);
/*        if($cart->doesntExist()){
            $this->createCart();
            $cart = User::GetCart($this->user_id);
            return $cart;
        }*/
        self::updateCart($cart);
        if($cart->exists()) {
            $this->cart = $cart;
            return $cart;
        }
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
                'total_final_price'=>0,
            ]);
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function findCartItemByProductID($product_id)
    {
        return $this->getCart()
            ->items()
            ->where('line_item_type','!=','shipping')
            ->where('line_item_id',$product_id)
            ->first();
    }

    private function getCartItem($item_type='product',$item_id,$quantity)
    {
        $model = '\\App\\Models\\' . ucfirst($item_type);
        $item = $model::query()->find($item_id);
        $cartItem = [];
        $cartItem['line_item_type'] = $item_type;
        $cartItem['line_item_id'] = $item_id;
        $cartItem['is_virtual'] = $item->is_virtual;
        $cartItem['main_price'] = $item->price;
        $cartItem['price'] = $item->sale_price ?? $item->price;
        $cartItem['quantity'] = $quantity;
        $cartItem['total_main_price'] = $quantity * $cartItem['main_price'];
        $cartItem['total_price'] = $quantity * $cartItem['price'];
        // if has discount need to change
        $cartItem['total_final_price'] = $quantity * $cartItem['price'];


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
            $item->total_main_price = $item->quantity * $item->main_price;
            $item->total_final_price = $item->quantity * $item->price;
            // how i can update if cart has discount
            if($item->discount_applied==1){

            }
            $item->save();
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
        return $item;
    }

    private function updateCart($cart)
    {
        try {
            $cart->total_price = $cart->items()->where('line_item_type','!=','shipping')->sum('total_price');
            // if cart has main price
            if($cart->items()->where('line_item_type','!=','shipping')->whereNotNull('total_main_price')->exists()){
                $cart->total_main_price = $cart->items()->where('line_item_type','!=','shipping')->sum('total_main_price');
            }
            $cart->total_final_price = $cart->items()->where('line_item_type','!=','shipping')->sum('total_final_price');

            if($cart->total_after_discount!==0 && $cart->total_after_discount!==null){
                $cart->total_final_price = $cart->total_after_discount;
            }
            if($cart->total_shipping_price!==0 && $cart->total_shipping_price !== null){
                if($cart->total_final_price + $cart->total_shipping_price != $cart->total_final_price){
                    $cart->total_final_price += $cart->total_shipping_price;
                }
            }

            // if cart has discount : remove or add to cart change discounts
//            if ($cart->discount_id !== null) {
//                $discountService = new DiscountService(); // ایجاد نمونه از کلاس DiscountService
//                $this->applyDiscountToCart($cart, $discountService, $cart->discount_id);
//            }

            // after shipping selected final price increased
            $cart->save();
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
        return $cart;
    }


    public function addToCart($id,$quantity=1,$is_virtual=0)
    {
        $cart = self::getCart();
        if(!$cart){
            $cart = self::createCart();
        }
        $cartItem = $cart->items()->firstOrCreate([
            'line_item_id'=>$id,
            'line_item_type'=> 'product',
        ],self::getCartItem('product',$id,$quantity));

        if(!$cartItem->wasRecentlyCreated){
            self::calculateItem($cartItem,$quantity,'+');
        }
        self::removeDiscount();

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
                'line_item_type'=> 'product'
                ]);
            // IF Cart Exists
            if($item->exists()){
                $currentItem = $item->first();
                $currentItem = self::calculateItem($currentItem,$quantity,'-');
                if(!$currentItem){
                    $cart->delete();
                }
            }
            if ($cart->discount_id !== null) {
                self::removeDiscount();
            }
        }

        return self::getCart();
    }

    public function removeDiscount()
    {
        $cart = self::getCart();
        if($cart){
            //Get Current Cart Item
            $item = $cart->items()
                ->where([
                'discount_applied'=> 1
                ]);
            // IF Cart Exists
            if($item->exists()){
                foreach ($item->get() as $value){
                    $item->update([
                        'discount_applied' => 0,
                        'discount_amount'=> null,
                        'total_discount_amount'=>null,
                        'total_after_discount'=> null,
                    ]);
                    self::updateItem($value);
                }
            }
            $cart->update([
                'discount_id'=> null,
                'total_discount_amount'=> null,
                'total_after_discount'=> null,
            ]);
            self::updateCart($cart);
        }

        return self::getCart();
    }

    public function emptyCary()
    {
        $cart = $this->getCart(false);
        if($cart){
            $cart->items()->delete();
            $cart->total_price = 0;
            $cart->total_main_price = 0;
            $cart->total_final_price = 0;
            $cart->total_shipping_price = null;
            $cart->total_discount_amount = null;
            $cart->total_after_discount = null;
            $cart->save();
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
        return self::getCart()->total_final_price;
    }

    public function getCartTotalWithoutShipping()
    {
        $cart = self::getCart();
        return $cart->total_final_price - $cart->total_discount_amount;
    }
    public function getSumQuantities()
    {
            return (int)self::getCart()->items()->where('line_item_type','!=','shipping')->sum('quantity');
    }
    public function getNotDiscountedQuantities()
    {
        return (int)self::getCart()->items()->where('line_item_type','!=','shipping')->where('discount_applied','!=',1)->sum('quantity');
    }
    public function getShippingItem($shipping_id)
    {
        $shippingItem = self::getCartItem('shipping',$shipping_id,1);
        $shippingItem['is_virtual']= false;
        $shippingItem['price']= false;
        $shippingItem['total_price']= false;
        return $shippingItem;
    }

    public function addShipping($shipping_id,$shipping_price)
    {
        $cart = self::getCart(false);
        $shippingItem = $cart->items()->where('line_item_type','shipping');
        if($shippingItem->exists()){
            $shippingItem->update([
                'line_item_id'=>$shipping_id,
                'line_item_type'=> 'shipping',
                'is_virtual'=> false,
                'price'=> $shipping_price,
                'total_price'=> $shipping_price,
                'total_final_price'=> $shipping_price,
            ]);
        } else {
            $shippingItem->create([
                'line_item_id'=>$shipping_id,
                'line_item_type'=> 'shipping',
                'is_virtual'=> false,
                'price'=> $shipping_price,
                'total_price'=> $shipping_price,
                'total_final_price'=> $shipping_price,
                'quantity' => 1,
            ]);
        }
        $cart = self::getCart();
        $cart->update([
            'total_shipping_price'=> $shipping_price,
        ]);
        return $cart;
    }
}
