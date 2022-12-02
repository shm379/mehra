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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('/cart')
        ->name('cart.')
        ->controller('App\Http\Controllers\Api\Global\CartController')
        ->group(function(){
            Route::get('/', 'getCart')->name('get-cart');
            Route::post('/add', 'addItem')->name('add-item');
            Route::post('/remove', 'removeItem')->name('remove-item');
            Route::post('/checkout', 'checkout')->name('checkout');
        });
});
/*
 * V1 Without Auth
 */
Route::get('books/{book}', [\App\Http\Controllers\Api\Product\BookController::class, 'show'])->name('books.show');
//Route::get('books/{book:id}', [\App\Http\Controllers\Api\Product\BookController::class, 'show'])->name('books.showById');
Route::apiResource('books', \App\Http\Controllers\Api\Product\BookController::class)->only('index');
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
