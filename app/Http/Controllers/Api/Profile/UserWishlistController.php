<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\UserWishlistResourceCollection;
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
        $wishlist = auth()->user()->wishlist->load('product');
        return new UserWishlistResourceCollection($wishlist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserWishlist  $userWishlist
     * @return \Illuminate\Http\Response
     */
    public function show(UserWishlist $userWishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserWishlist  $userWishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserWishlist $userWishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserWishlist  $userWishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserWishlist $userWishlist)
    {
        //
    }
}
