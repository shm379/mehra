<?php

use App\Http\Controllers\Api\AutocompleteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth.mehra'])->group(function (){
Route::middleware(['auth:sanctum','verifiedMobile'])->group(function (){
    Route::get('/me', [\App\Http\Controllers\Api\Auth\AuthController::class,'getMe'])->name('get-me');
    Route::post('/me', [\App\Http\Controllers\Api\Auth\AuthController::class,'updateMe'])->name('update-me');
});
/*
 * V1 API LOGGED IN ROUTES
 */
Route::middleware(['auth:sanctum','verifiedMobile'])->group(function () {
    //cart
    Route::prefix('/cart')
        ->name('cart.')
        ->group(function(){
            Route::post('/discount', [App\Http\Controllers\Api\Global\DiscountController::class,'setDiscount'])->name('set-discount');
            Route::get('/', [App\Http\Controllers\Api\Global\CartController::class,'getCart'])->name('get-cart');
            Route::post('/add', [App\Http\Controllers\Api\Global\CartController::class,'addItem'])->name('add-item');
            Route::post('/remove', [App\Http\Controllers\Api\Global\CartController::class,'removeItem'])->name('remove-item');
        });

    //checkout
    Route::prefix('/checkout')
        ->controller('App\Http\Controllers\Api\Global\CheckoutController')
        ->group(function(){
            Route::post('/', 'cartToCheckout')->name('checkout');
            Route::post('/callback', 'checkoutCallback')->name('checkout.callback');
        });


    //shipping - tapin
    Route::prefix('/states')
        ->controller('App\Http\Controllers\Api\Global\ShippingController')
        ->group(function(){
            Route::post('/', 'getStates')->name('get-states');
            Route::post('/{state}', 'getCities')->name('get-cities');
        });

    //profile
    Route::prefix('/profile')
        ->group(function (){
            // user address
            Route::apiResource('addresses',\App\Http\Controllers\Api\Profile\UserAddressController::class);
            // user orders
            Route::get('orders',\App\Http\Controllers\Api\Profile\OrderController::class);
            // user wishlist
            Route::apiResource('wishlist',\App\Http\Controllers\Api\Profile\UserWishlistController::class)->only(['index']);
            // user collection with wishlist
            Route::apiResource('collections/wishlist',\App\Http\Controllers\Api\Profile\UserCollectionWishlistController::class)->only(['index']);
           // user messages
            Route::get('messages',\App\Http\Controllers\Api\Profile\MessageController::class);
           // user views
            Route::get('last-visits',\App\Http\Controllers\Api\Profile\UserViewController::class);
        });

    // user like product
    Route::post('/product/{product}/like',[\App\Http\Controllers\Api\Profile\UserWishlistController::class, 'store'])->name('product.like');
    // user unlike product
    Route::delete('/product/{product}/like',[\App\Http\Controllers\Api\Profile\UserWishlistController::class, 'destroy'])->name('product.unlike');
    // user like collection
    Route::post('/collection/{collection}/like',[\App\Http\Controllers\Api\Profile\UserCollectionWishlistController::class, 'store'])->name('collection.like');
    // user unlike collection
    Route::delete('/collection/{collection}/like',[\App\Http\Controllers\Api\Profile\UserCollectionWishlistController::class, 'destroy'])->name('collection.unlike');
    //comment like
    Route::post('/comment/{comment}/like',[\App\Http\Controllers\Api\Product\CommentLikeController::class, 'store'])->name('comment.like');
    // comment unlike
    Route::delete('/comment/{comment}/like',[\App\Http\Controllers\Api\Product\CommentLikeController::class, 'destroy'])->name('comment.unlike');
    // send comment
    Route::apiResource('product.comments', \App\Http\Controllers\Api\Product\CommentController::class)->only('store');

});

    /*
    * V1 API AUTH CONTROLLER
    */
    Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
        Route::middleware(['auth:sanctum', 'abilities:verify-otp'])->post('/verify', 'verifyOTP')->name('verify-otp');
        Route::middleware(['auth:sanctum','verifiedMobile'])->post('/refresh', 'refreshToken')->name('refresh-token');
    });
});
/*
 * V1 Without Auth
 */
Route::middleware(['throttle:OTP'])->post('/otp', [\App\Http\Controllers\Api\Auth\AuthController::class,'sendOTP'])->name('send-otp');
Route::get('product/{product}/rank-attributes', [\App\Http\Controllers\Api\Product\ProductController::class,'getRanks'])->name('product.ranks');
Route::apiResource('books', \App\Http\Controllers\Api\Product\BookController::class)->only('index','show');
Route::apiResource('product.comments', \App\Http\Controllers\Api\Product\CommentController::class)->only('index');
Route::get('filters/books', [\App\Http\Controllers\Api\Product\BookController::class,'filters'])->name('filters.books');
Route::apiResource('awards', \App\Http\Controllers\Api\Product\AwardController::class)->only('index','show');
Route::apiResource('categories', \App\Http\Controllers\Api\Product\CategoryController::class)->only('index','show');
Route::apiResource('collections', \App\Http\Controllers\Api\Product\CollectionController::class)->only('index','show');
Route::apiResource('creators', \App\Http\Controllers\Api\Product\CreatorController::class)->only('index','show');
Route::apiResource('producers', \App\Http\Controllers\Api\Product\ProducerController::class)->only('index','show');
Route::apiResource('product-groups', \App\Http\Controllers\Api\Product\ProductGroupController::class)->only('index', 'show');
