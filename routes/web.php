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

Route::get('/dashboard', function () {
    dd(auth()->user()->following);

//    OTP('+98939172790');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('user-datatables', function () {
    return view('admin.users.index');
});
require __DIR__.'/auth.php';
