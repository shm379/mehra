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

Route::middleware(['auth:sanctum','abilities:view-user'])->group(function (){
    Route::get('/me', function (Request $request) {
        return response()->json($request->user('sanctum'));
    })->name('me');
    Route::post('/me', function (Request $request) {
        $request->user('sanctum')->update($request->toArray());
    })->name('me');
});
/*
 * V1 API LOGGED IN ROUTES
 */
Route::middleware(['auth:sanctum','abilities:view-user'])->group(function () {
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
            Route::apiResource('wishlist',\App\Http\Controllers\Api\Profile\UserWishlistController::class);
           // user messages
            Route::get('messages',\App\Http\Controllers\Api\Profile\MessageController::class);
           // user views
            Route::get('last-visits',\App\Http\Controllers\Api\Profile\UserViewController::class);
        });

    //comments
    Route::apiResource('product.comments', \App\Http\Controllers\Api\Product\CommentController::class)->only('index','store');
});

/*
 * V1 Without Auth
 */
Route::apiResource('books', \App\Http\Controllers\Api\Product\BookController::class)->only('index','show');
Route::get('filters/books', [\App\Http\Controllers\Api\Product\BookController::class,'filters'])->name('filters.books');
Route::apiResource('awards', \App\Http\Controllers\Api\Product\AwardController::class)->only('index','show');
Route::apiResource('categories', \App\Http\Controllers\Api\Product\CategoryController::class)->only('index','show');
Route::apiResource('collections', \App\Http\Controllers\Api\Product\CollectionController::class)->only('index','show');
Route::apiResource('creators', \App\Http\Controllers\Api\Product\CreatorController::class)->only('index','show');
Route::apiResource('producers', \App\Http\Controllers\Api\Product\ProducerController::class)->only('index','show');
Route::apiResource('product-groups', \App\Http\Controllers\Api\Product\ProductGroupController::class)->only('index', 'show');
/*
* V1 API AUTH CONTROLLER
*/
Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
    Route::middleware(['throttle:OTP'])->post('/otp', 'sendOTP')->name('send-otp');
    Route::middleware(['auth:sanctum', 'abilities:verify-otp'])->post('/verify', 'verifyOTP')->name('verify-otp');
    Route::middleware(['auth:sanctum','abilities:view-user'])->post('/refresh', 'refreshToken')->name('refresh-token');
});
/*
* V1 ADMIN INERTIA CONTROLLER
*/
Route::get('/ac/producers/publishers/{q}', [AutocompleteController::class, 'publishers'])->name('ac.publishers');
Route::get('/ac/producers/brands/{q}', [AutocompleteController::class, 'brands']);
Route::get('/ac/producers/producers/{q}', [AutocompleteController::class, 'producers']);
Route::get('/ac/creators/authors/{q}', [AutocompleteController::class, 'authors']);
Route::get('/ac/creators/translators/{q}', [AutocompleteController::class, 'translators']);
Route::get('/ac/creators/narrators/{q}', [AutocompleteController::class, 'narrators']);
Route::get('/ac/creators/illustrators/{q}', [AutocompleteController::class, 'illustrators']);
Route::get('/ac/publishers/{q}', [AutocompleteController::class, 'publishers'])->name('ac.publishers');
Route::get('/ac/creators/types/{q}', [AutocompleteController::class, 'creatorTypes']);
Route::get('/ac/creators/{q}', [AutocompleteController::class, 'authors']);
Route::get('/ac/translators/{q}', [AutocompleteController::class, 'translators']);
Route::get('/ac/narrators/{q}', [AutocompleteController::class, 'narrators']);
Route::get('/ac/illustrators/{q}', [AutocompleteController::class, 'illustrators']);
Route::get('/ac/categories/{q}', [AutocompleteController::class, 'categories']);
Route::get('/ac/collections/{q}', [AutocompleteController::class, 'collections']);
Route::get('/ac/attributes', [AutocompleteController::class, 'attribute']);
Route::get('/ac/awards/{q}', [AutocompleteController::class, 'award']);
