<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Discount;
use App\Models\User;
class DiscountService extends CartService
{
    public $discount = null;
    public function applyDiscount($code)
    {
        $totalDiscount = 0;
        $cart = self::getCart();
        if($cart) {
            $discount = self::getDiscount($code);
            // if discount does not exists
            if (!$discount) {
                return false;
            }
            $this->discount = $discount;
            $this->setDiscount($cart->items);
            // if discount exists
            $items = self::getCart();
            $cart->discount_id = $discount->id;
            $cart->total_price_without_discount = $items->items()->sum('total_price_without_discount');
            $cart->total_price = $items->items()->sum('total_price');
            $cart->save();

            return true;
        }
    }

    private function getDiscount($code)
    {
        return Discount::query()
            ->where('code',$code)
            ->whereNull('expire_at')
            ->whereNull('start_time')
            ->whereNull('end_time')
            ->orWhere('expire_at','>=', now())
            ->orWhere('start_time','<=', now())
            ->orWhere('end_time','>=', now())
            ->first();
    }

    private function setDiscount($items)
    {
        $products = $items->where('line_item_type', 'product');
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
                if ($this->getCartTotal() !== 0) {
                    $amount = $this->getAmountOfDiscount();
                    foreach ($products as $orderItem) {
                        if ($orderItem->discount_applied==0) {
                            // get price of order item with discount
                            $discountPrice = $this->getDiscountItemPrice(
                                $amount,
                                $orderItem->price
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
            // set order item without discount
            $orderItem->price_without_discount = $orderItem->price;
            $orderItem->total_price_without_discount = $this->getOrderItemTotalPrice(
                $orderItem->price,
                $orderItem->quantity
            );
            // set order item with discount
            $orderItem->price = $discountPrice;
            $orderItem->total_price = $this->getOrderItemTotalPrice(
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
        if ($this->getCartTotal() !== 0 && $quantities !== 0) {
            if ($this->discount->is_percent)
                $amount = (($this->getCartTotal() * 100)/$this->discount->amount) / $quantities;
            else
                $amount = $this->discount->amount / $quantities;

            return $amount;
        }
    }
}
