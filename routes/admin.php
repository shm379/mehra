<?php
use Inertia\Inertia;
<<<<<<< HEAD
use \Illuminate\Support\Facades\Route;
=======

>>>>>>> 9a1469e443bee614da5c9fb14625c0bbc11e3a15
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('/admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function (){

        Route::get("/", function () {
            return Inertia::render("Dashboard");
        });

        Route::prefix('user')
            ->controller(\App\Http\Controllers\Admin\UserController::class)
            ->name('users.')
            ->group(function () {
                Route::get("/profile", 'profile')->name('profile');
                Route::post("/", 'store')->name('store');
                Route::get("/", 'index')->name('index');
                Route::get("/{id}", 'show')->name('show');
                Route::get("/{id}/edit", 'edit')->name('edit');
                Route::delete("/{id}", 'delete')->name('delete');
            });
        Route::resource('attributes', \App\Http\Controllers\Admin\AttributeController::class);
        Route::resource('awards', \App\Http\Controllers\Admin\AwardController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('creators', \App\Http\Controllers\Admin\CreatorController::class);
<<<<<<< HEAD
        Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class)->except(['create','store']);
=======
        Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class);
>>>>>>> 9a1469e443bee614da5c9fb14625c0bbc11e3a15
        Route::get('notifications', [\App\Http\Controllers\Admin\NotificationController::class,'index'])->name('notifications.index');
        Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class);
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::resource('producers', \App\Http\Controllers\Admin\ProducerController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('product-groups', \App\Http\Controllers\Admin\ProductGroupController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('volumes', \App\Http\Controllers\Admin\VolumeController::class);
    });
