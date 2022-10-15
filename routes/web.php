<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    '/producers'=>\App\Http\Controllers\ProducerController::class,
    '/award'=>\App\Http\Controllers\AwardController::class,
    '/category'=>\App\Http\Controllers\CategoryController::class,
    '/product'=>\App\Http\Controllers\ProductController::class,
    '/creator'=>\App\Http\Controllers\CreatorController::class,
    '/page'=>\App\Http\Controllers\PageController::class,
    '/attributes'=>\App\Http\Controllers\AttributeController::class,
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
