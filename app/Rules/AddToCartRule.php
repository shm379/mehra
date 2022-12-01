<?php

namespace App\Rules;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Contracts\Validation\InvokableRule;

class AddToCartRule implements InvokableRule
{

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        // check if product quantity with cart quantity
        $user = auth()->user();
        $quantity = 1;
        $product = Product::query()->find($value);
        if($product && $user) {
            $dontAvailable = !$product->is_available;
            $inStockCount = $product->in_stock_count;
            $dontInStock = $inStockCount <= 0;
//            $minPurchasesPerUser = $product->min_purchases_per_user;
            $maxPurchasesPerUser = $product->max_purchases_per_user;
//            $minPurchasesPerUserLimit = false;
            $maxPurchasesPerUserLimit = $maxPurchasesPerUser>=request()->quantity;
            $maxPurchasesPerUserLimitAndDontInStock = $maxPurchasesPerUserLimit && $dontInStock;
            $cart = $user->GetCart($user->id);
            if($cart->exists() && count($cart->items)) {
                // get cart quantity
                $cartItemQuantity = $cart->items->where('line_item_id', $value)->first()->quantity;
                // if cart item quantity larger than in stock count
                if($cartItemQuantity>=$inStockCount){
                    $dontInStock = true;
                }
                // if min purchases per user smaller than cart item quantity
//                if($minPurchasesPerUser>$cartItemQuantity){
//                    $minPurchasesPerUserLimit = true;
//                }
                // if max purchases per user larger or equal than cart item quantity
                if($maxPurchasesPerUser<=$cartItemQuantity && ($maxPurchasesPerUser+$cartItemQuantity)>$inStockCount){
                    $maxPurchasesPerUserLimitAndDontInStock = true;
                }
                // if max purchases per user larger or equal than cart item quantity
                if($maxPurchasesPerUser<=$cartItemQuantity){
                    $maxPurchasesPerUserLimit = true;
                }

            }

            if ($dontAvailable)
                return $fail('محصول مورد نظر قابل خرید نیست!');
//            if ($minPurchasesPerUserLimit)
//                return $fail('تعداد درخواستی شما برای خرید کم تر از حد مجاز است!');
            if ($maxPurchasesPerUserLimitAndDontInStock)
                return $fail('تعداد درخواستی شما برای خرید این محصول بیشتر از موجودی انبار است!');
            if ($dontInStock)
                return $fail('موجودی این محصول به اتمام رسیده است!');
            if ($maxPurchasesPerUserLimit)
                return $fail('تعداد درخواستی شما برای خرید بیش تر از حد مجاز است!');
        }
    }
}
