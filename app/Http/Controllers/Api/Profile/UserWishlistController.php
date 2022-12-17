<?php

namespace App\Http\Controllers\Api\Profile;

use App\Exceptions\MehraApiException;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Profile\StoreUserWishlistRequest;
use App\Http\Resources\UserWishlistResourceCollection;
use App\Models\Product;
use App\Models\UserWishlist;
use Illuminate\Http\Request;

class UserWishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserWishlistResourceCollection
     */
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->with('product')->paginate($this->perPage);
        return new UserWishlistResourceCollection($wishlist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Product $product)
    {
        try {
            $wishlist = auth()->user()->wishlist();
            if(!$wishlist->where('product_id',$product->id)->exists()) {
                $wishlist->create([
                    'product_id' => $product->id,
                    'user_id' => $this->user_id,
                ]);
                return $this->successResponse('این محصول در لیست علاقه‌مندی ها قرار گرفت');
            } else {
                return $this->errorResponse('این محصول قبلا در لیست علاقه‌مندی ها قرار گرفته است');
            }
        } catch (MehraApiException $exception){}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            $wishlist = auth()->user()->wishlist();
            if(!$wishlist->where('product_id',$product->id)->exists()) {
                return $this->successResponse('این محصول در لیست علاقه‌مندی های شما وجود ندارد!');
            } else {
                $wishlist->where('product_id',$product->id)->delete();
                return $this->errorResponse('این محصول از لیست علاقه‌مندی ها خارج شد');
            }
        } catch (MehraApiException $exception){}
    }
}
