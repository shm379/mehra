<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\ProductStructure;
use App\Exceptions\MehraApiException;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Discount;
use App\Models\User;
class DiscountService extends CartService
{
    public $discount = null;
    private function getDiscount($code)
    {
        return Discount::query()
            ->where('code',$code)
            ->first();
    }
    private function getDiscountAmount($total)
    {
        $quantities = $this->getSumQuantities();
        $amount = 0;
        // get discount amount
        if ($total !== 0 && $quantities !== 0) {
            if ($this->discount->is_percent) {
                $amount = (($total * 100) / $this->discount->amount) / $quantities;
            }
            else
                $amount = $this->discount->amount / $quantities;

        }
        return $total-$amount;
    }

    private function updateCartItemsDiscount($discountAmount)
    {

        if($this->cart){
            $cart = $this->cart;
        } else {
            $cart = self::getCart();
        }

        foreach ($cart->items->where('line_item_type','!=','shipping')->where('discount_applied','!=',1) as $item){
            //if bigger than total price
            if($discountAmount>$item->total_price){
                $discountAmount = $item->price;
                $totalDiscountAmount = $item->total_price;
            } else {
                $totalDiscountAmount = round($discountAmount) * $item->quantity;
            }
            if($item->total_price<$totalDiscountAmount){
                $totalAfterDiscount = 0;
            } else {
                $totalAfterDiscount = $item->total_price - $totalDiscountAmount;
            }
            $item->update([
                'discount_applied'=>1,
                'discount_amount'=> round($discountAmount),
                'total_discount_amount'=> $totalDiscountAmount,
                'total_after_discount'=> $totalAfterDiscount,
                'total_final_price'=> $totalAfterDiscount
            ]);
        }
    }
    private function updateCartDiscount()
    {
        if($this->cart){
            $cart = $this->cart;
        } else {
            $cart = self::getCart();
        }

        $totalDiscountAmount = $cart->items->where('line_item_type','!=','shipping')->sum('total_discount_amount');
        $totalAfterDiscount = $cart->items->where('line_item_type','!=','shipping')->sum('total_after_discount');
        $totalShippingPrice = $cart->total_shipping_price ?? 0;
        $totalFinalPrice = $cart->items->where('line_item_type','!=','shipping')->sum('total_final_price') - $totalShippingPrice;
        $cart->update([
           'discount_id' => $this->discount->id,
           'total_discount_amount'=>$totalDiscountAmount,
           'total_after_discount'=>$totalAfterDiscount,
           'total_final_price'=>$totalFinalPrice
        ]);
    }

    public function applyDiscount($code)
    {
        try {
            // get discount
            $discount = self::getDiscount($code);
            // if discount does not exist
            if (!$discount) {
                return false;
            }
            // set discount in discount property
            $this->discount = $discount;
            // get cart
            $cart = self::getCart();
            // get price of discount
            $discountAmount = $this->getDiscountAmount($cart->total_price);
            // set discount to items in cart for items not applied discount
            if($this->getNotDiscountedQuantities()!==0) {
                $discountAmountPerItem = $discountAmount / $this->getNotDiscountedQuantities();
                $this->updateCartItemsDiscount($discountAmountPerItem);
                // update cart with discount price
                $this->updateCartDiscount();
            }
            return true;
        } catch (MehraApiException $exception){

        }

    }

    /*public function applyDiscount($code)
    {
        $totalDiscount = 0;
        $discount = self::getDiscount($code);
        // if discount does not exist
        if (!$discount) {
            return false;
        }
        $cart = self::getCart();
        $this->discount = $discount;
        $this->setDiscount($cart->items);
        // if discount exists
        $items = $cart;
        $cart->discount_id = $discount->id;
        $cart->total_discount_amount = $items->items()->where('line_item_type', '!=', 'shipping')->sum('total_discount_amount');
        $final_price = $cart->shipping_price ?? 0;
        $cart->total_after_discount = $items->items()->where('line_item_type', '!=', 'shipping')->sum('total_after_discount');
        $cart->total_final_price = $final_price + $items->items()->where('line_item_type', '!=', 'shipping')->sum('total_final_price');
        $cart->save();

        return true;
    }*/
/*


    private function setDiscount($items)
    {
        $products = $items->whereIn('line_item_type', ['product']);
        if (count($items)>0) {
            // check product limitation
            if ($this->discount->limitProducts())
                $products = $this->getDiscountedProducts($products);

            // apply order items discount
            $this->setOrderItemsDiscount($products);
        }
    }

    public function setOrderItemsDiscount($products)
    {
        if ($products) {
            if ($this->discount) {
                // get discount amount of every order item
                if ($this->getCartTotalWithoutShipping() !== 0) {
                    $amount = $this->getAmountOfDiscount();
                    foreach ($products as $orderItem) {
                        if ($orderItem->discount_applied==0) {
                            // get price of order item with discount
                            $discountPrice = $this->getDiscountItemPrice(
                                $amount,
                                $orderItem->total_price
                            );
                            // save order item with discount price
                            $this->saveOrderItemDiscount($orderItem,$discountPrice);
                        }
                    }
                }
            }
        }
    }

    public function getDiscountedProducts($products)
    {
        if ($products) {
            if ($this->discount && $this->discount->limitProducts()) {
                return $products->whereIn('line_item_id',$this->discount->products->pluck('id')->toArray());
            }
        }
    }

    public function getOrderItemTotalPrice($price,$quantity=1)
    {
        if($price==0)
            return 0;
        return $price * $quantity;
    }

    private function getDiscountItemPrice($discountPrice,$mainPrice)
    {
        if(($mainPrice-$discountPrice)>=0)
            $calculateDiscount = $mainPrice - $discountPrice;

        if(($discountPrice-$mainPrice)>=0)
            $calculateDiscount = $discountPrice - $mainPrice;


        return $calculateDiscount>0 ? $calculateDiscount : 0;
    }

    private function saveOrderItemDiscount($orderItem,$discountPrice)
    {
        try {
            $orderItem->discount_applied = 1;
            // set order item with discount
            $orderItem->discount_amount = $discountPrice;
            $orderItem->total_price_after_discount = $this->getOrderItemTotalPrice(
                $discountPrice,
                $orderItem->quantity
            );
            $orderItem->total_final_price = $this->getOrderItemTotalPrice(
                $discountPrice,
                $orderItem->quantity
            );
            $orderItem->save();
        } catch (\Exception $exception){

        }
    }

    private function getAmountOfDiscount()
    {
        $quantities = $this->getSumQuantities();
        // get discount amount
        if ($this->getCartTotalWithoutShipping() !== 0 && $quantities !== 0) {
            if ($this->discount->is_percent)
                $amount = (($this->getCartTotalWithoutShipping() * 100)/$this->discount->amount) / $quantities;
            else
                $amount = $this->discount->amount / $quantities;

            return $amount;
        }
    }
*/
}
