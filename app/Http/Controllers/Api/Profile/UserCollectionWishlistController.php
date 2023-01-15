<?php

namespace App\Http\Controllers\Api\Profile;

use App\Enums\ProductStructure;
use App\Exceptions\MehraApiException;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\UserWishlistResourceCollection;
use App\Models\Collection;
use App\Models\Product;
use App\Models\UserWishlist;
use Illuminate\Http\Request;

class UserCollectionWishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserWishlistResourceCollection
     */
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->where('model_type','collection')->with('model')->paginate($this->perPage);
        return new UserWishlistResourceCollection($wishlist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Collection $collection)
    {
        try {
            $wishlist = auth()->user()->wishlist();
            if(!$wishlist->whereIn('model_type',['collection'])->where('model_id',$collection->id)->exists()) {
                $wishlist->create([
                    'model_id' => $collection->id,
                    'model_type' => 'collection',
                    'user_id' => $this->user_id,
                ]);
                return $this->successResponse('این مجموعه در لیست علاقه‌مندی ها قرار گرفت');
            } else {
                return $this->errorResponse('این مجموعه قبلا در لیست علاقه‌مندی ها قرار گرفته است');
            }
        } catch (MehraApiException $exception){}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Collection $collection)
    {
        try {
            $wishlist = auth()->user()->wishlist();
            if(!$wishlist->whereIn('model_type',['collection'])->where('model_id',$collection->id)->exists()) {
                return $this->successResponse('این مجموعه در لیست علاقه‌مندی های شما وجود ندارد!');
            } else {
                $wishlist->whereIn('model_type',['collection'])->where('model_id',$collection->id)->delete();
                return $this->errorResponse('این مجموعه از لیست علاقه‌مندی ها خارج شد');
            }
        } catch (MehraApiException $exception){}
    }
}
