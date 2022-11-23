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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
 * V1 API LOGGED IN ROUTES
 */
Route::prefix('/v1')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/cart', [\App\Http\Controllers\Api\Global\CartController::class, 'content']);
    Route::post('/cart/add-item', [\App\Http\Controllers\Api\Global\CartController::class, 'addItem']);
});
/*
 * V1 Without Auth
 */
Route::prefix('/v1')->group(function () {
    Route::apiResource('products', \App\Http\Controllers\Api\Product\ProductController::class)->only('index', 'show');
    Route::apiResource('product-groups', \App\Http\Controllers\Api\Product\ProductGroupController::class)->only('index', 'show');
});
/*
* V1 API AUTH CONTROLLER
*/
Route::prefix('/v1')->controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
    Route::middleware(['throttle:OTP'])->post('/send-otp', 'sendOTP');
    Route::post('/validate-otp', 'verifyOTPAndLogin');
    Route::post('/check-exists', 'checkExists');
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
});
