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
    Route::post("/me/upload", \App\Http\Controllers\Api\Global\TemporaryUploadController::class)
        ->middleware(['throttle:api-temporary-upload']);
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
            Route::post('/address', [App\Http\Controllers\Api\Global\ShippingController::class,'setAddress'])->name('select-address-cart');
            Route::post('/sync', [App\Http\Controllers\Api\Global\CartController::class,'syncCart'])->name('sync-cart');
            Route::post('/add', [App\Http\Controllers\Api\Global\CartController::class,'addItem'])->name('add-item');
            Route::post('/remove', [App\Http\Controllers\Api\Global\CartController::class,'removeItem'])->name('remove-item');
            Route::post('/empty', [App\Http\Controllers\Api\Global\CartController::class,'emptyCart'])->name('empty-cart');

        });

    //checkout
    Route::prefix('/checkout')
        ->controller('App\Http\Controllers\Api\Global\CheckoutController')
        ->group(function(){
            Route::post('/', 'cartToCheckout')->name('checkout.pay');
            Route::post('/verify', 'verifyPayment')->name('checkout.verify');
            Route::get('/factor/{order_id}',[\App\Http\Controllers\Api\Profile\Factor::class,'show']);
        });

    //shipping
    Route::prefix('/shipping')
        ->controller('App\Http\Controllers\Api\Global\ShippingController')
        ->group(function(){
            Route::post('/price', 'calculate')->name('shipping.calculate');
        });

    //profile
    Route::prefix('/profile')
        ->group(function (){
            // user address
            Route::apiResource('addresses',\App\Http\Controllers\Api\Profile\UserAddressController::class);
            // user orders
            Route::get('orders',\App\Http\Controllers\Api\Profile\OrderController::class);
            // user wishlist
            Route::apiResource('wishlist',\App\Http\Controllers\Api\Profile\UserProductWishlistController::class)->only(['index']);
            // user collections with wishlist
            Route::get('collections/me',[\App\Http\Controllers\Api\Profile\UserCollectionWishlistController::class,'index'])->name('collections.wishlist.index');
           // user messages
            Route::get('messages',[\App\Http\Controllers\Api\Profile\MessageController::class,'index'])->name('messages');
            Route::post('messages/{message}',[\App\Http\Controllers\Api\Profile\MessageController::class,'store'])->name('messages.store');
           // user views
            Route::get('last-visits',\App\Http\Controllers\Api\Profile\UserViewController::class);
        });

    // user like product
    Route::post('/product/{product}/like',[\App\Http\Controllers\Api\Profile\UserProductWishlistController::class, 'store'])->name('product.like');
    // user unlike product
    Route::delete('/product/{product}/like',[\App\Http\Controllers\Api\Profile\UserProductWishlistController::class, 'destroy'])->name('product.unlike');
    // user like collection
    Route::post('/collection/{collection}/like',[\App\Http\Controllers\Api\Profile\UserCollectionWishlistController::class, 'store'])->name('collection.like');
    // user unlike collection
    Route::delete('/collection/{collection}/like',[\App\Http\Controllers\Api\Profile\UserCollectionWishlistController::class, 'destroy'])->name('collection.unlike');
    //comment like
    Route::post('/comment/{comment}/like',[\App\Http\Controllers\Api\Product\CommentLikeController::class, 'store'])->name('comment.like');
    // comment unlike
    Route::delete('/comment/{comment}/like',[\App\Http\Controllers\Api\Product\CommentLikeController::class, 'destroy'])->name('comment.unlike');
    // send comment
    Route::post("product/{product}/comments/upload", \App\Http\Controllers\Api\Global\TemporaryUploadController::class)->middleware(['throttle:api-temporary-upload']);
    Route::post('product/{product}/comments', [\App\Http\Controllers\Api\Product\CommentController::class,'store'])->name('comments.store');

    // reply comment
    Route::post("product/{product}/comments/reply/{comment}", [\App\Http\Controllers\Api\Product\CommentController::class,'reply'])->name('comments.reply');

});

    /*
    * V1 API AUTH CONTROLLER
    */
    Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
        Route::middleware(['auth:sanctum', 'abilities:verify-otp'])->post('/verify', 'verifyOTP')->name('verify-otp');
        Route::middleware(['auth:sanctum', 'abilities:verify-otp','throttle:OTP'])->post('/otp/force', 'sendOTPForce')->name('force-otp');
        Route::middleware(['auth:sanctum', 'abilities:verify-password'])->post('/password', 'verifyPassword')->name('verify-password');
        Route::middleware(['auth:sanctum','verifiedMobile'])->post('/password/forget', 'savePassword')->name('forget-password');
        Route::middleware(['auth:sanctum','verifiedMobile'])->post('/password/save', 'savePassword')->name('save-password');
        Route::middleware(['auth:sanctum','verifiedMobile'])->post('/refresh', 'refreshToken')->name('refresh-token');
    });
});
/*
 * V1 Without Auth
 */
Route::middleware(['throttle:OTP'])->post('/otp', [\App\Http\Controllers\Api\Auth\AuthController::class,'sendOTP'])->name('send-otp');
// reminded products
Route::post('product/{product}/reminded/{inCart?}',[\App\Http\Controllers\Api\Product\ProductController::class, 'reminded'])->name('product.reminded');
Route::get('product/{product}/rank-attributes', [\App\Http\Controllers\Api\Product\ProductController::class,'ranks'])->name('product.ranks');
Route::apiResource('books', \App\Http\Controllers\Api\Product\BookController::class)->only('index','show');
Route::get('product/{product}/comments', [\App\Http\Controllers\Api\Product\CommentController::class,'index'])->name('comments.index');
Route::get('filters/products', [\App\Http\Controllers\Api\Product\BookController::class,'filtersProduct'])->name('filters.products');
Route::get('filters/books', [\App\Http\Controllers\Api\Product\BookController::class,'filters'])->name('filters.books');
Route::apiResource('awards', \App\Http\Controllers\Api\Product\AwardController::class)->only('index','show');
Route::apiResource('categories', \App\Http\Controllers\Api\Product\CategoryController::class)->only('index','show');
Route::apiResource('collections', \App\Http\Controllers\Api\Product\CollectionController::class)->only('index','show');
Route::apiResource('creators', \App\Http\Controllers\Api\Product\CreatorController::class)->only('index','show');
Route::apiResource('producers', \App\Http\Controllers\Api\Product\ProducerController::class)->only('index','show');
//Route::apiResource('product-groups', \App\Http\Controllers\Api\Product\ProductGroupController::class)->only('index', 'show');
Route::apiResource('home', \App\Http\Controllers\Api\Global\HomeController::class)->only('index');
Route::get('search', [\App\Http\Controllers\Api\Global\SearchController::class, 'index'])->name('search.index');
Route::prefix('/states')
    ->controller('App\Http\Controllers\Api\Global\ShippingController')
    ->group(function(){
        Route::post('/', 'getStates')->name('get-states');
        Route::post('/{state}', 'getCities')->name('get-cities');
    });
