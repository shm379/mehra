<?php

namespace App\Http\Controllers\Api\Global;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Cart\SetDiscountRequest;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Services\DiscountService;

class DiscountController extends Controller
{
    /*
     * Discount Service Inject
     */
    protected DiscountService $discount;
    public function __construct(DiscountService $discount)
    {
        $this->discount = $discount;
    }

    /*
     * Apply Discount To Cart
     * @response Cart Resource
     */
    public function setDiscount(SetDiscountRequest $request)
    {
        if(!$this->discount->getCart()){
            return response()->json(['success'=>false,'message'=>'سبد خرید خالی می باشد']);
        }
        $this->discount->applyDiscount($request->input('code'));
        return new CartResource($this->discount->getCart());
    }
}
