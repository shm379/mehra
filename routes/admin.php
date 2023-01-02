<?php
use Inertia\Inertia;
use \Illuminate\Support\Facades\Route;

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
    ->middleware(['auth','role:admin'])
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
                Route::delete("/{id}", 'delete')->name('destroy');
            });
        Route::resource('attributes', \App\Http\Controllers\Admin\AttributeController::class);
        Route::resource('attributes.values', \App\Http\Controllers\Admin\AttributeValueController::class);
        Route::resource('awards', \App\Http\Controllers\Admin\AwardController::class);
        Route::resource('collections', \App\Http\Controllers\Admin\CollectionController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('creators', \App\Http\Controllers\Admin\CreatorController::class);
        Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class)->except(['create','store']);
        Route::get('notifications', [\App\Http\Controllers\Admin\NotificationController::class,'index'])->name('notifications.index');
        Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class);
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('stocks', \App\Http\Controllers\Admin\StockController::class);
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::resource('producers', \App\Http\Controllers\Admin\ProducerController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('product-groups', \App\Http\Controllers\Admin\ProductGroupController::class);
       // Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('volumes', \App\Http\Controllers\Admin\VolumeController::class);
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class,'index'])->name('settings.index');
        Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class,'update'])->name('settings.update');


    });
/*
        * V1 ADMIN INERTIA CONTROLLER
        */
        Route::prefix('/api/v1')
            ->middleware(['auth','role:admin'])
            ->name('admin.autocomplete.')
            ->group(function (){
                Route::get('/ac/producers/publishers/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'publishers'])->name('ac.publishers');
                Route::get('/ac/producers/brands/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'brands']);
                Route::get('/ac/producers/producers/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'producers']);
                Route::get('/ac/creators/authors/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'authors']);
                Route::get('/ac/creators/translators/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'translators']);
                Route::get('/ac/creators/narrators/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'narrators']);
                Route::get('/ac/creators/illustrators/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'illustrators']);
                Route::get('/ac/volumes/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'volumes']);
                Route::get('/ac/publishers/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'publishers']);
                Route::get('/ac/creators/types/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'creatorTypes']);
                Route::get('/ac/creators/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'authors']);
                Route::get('/ac/translators/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'translators']);
                Route::get('/ac/narrators/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'narrators']);
                Route::get('/ac/illustrators/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'illustrators']);
                Route::get('/ac/categories/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'categories']);
                Route::get('/ac/collection-types', [\App\Http\Controllers\Admin\AutocompleteController::class, 'collectionTypes']);
                Route::get('/ac/collections/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'collections']);
                Route::get('/ac/attributes/{attribute}/{title?}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'attributeValuesById'])->name('attributes.show');
                Route::get('/ac/attributes', [\App\Http\Controllers\Admin\AutocompleteController::class, 'attributes']);
                Route::get('/ac/attribute-types', [\App\Http\Controllers\Admin\AutocompleteController::class, 'attributeTypes']);
                Route::get('/ac/awards/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'award']);
                Route::get('/ac/cities/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'cities']);
                Route::get('/ac/attributeValues/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'attributeValues']);
                Route::get('/ac/products/{q}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'products']);
                Route::get('/ac/product-structures', [\App\Http\Controllers\Admin\AutocompleteController::class, 'productStructures']);
                Route::get('/ac/product-types', [\App\Http\Controllers\Admin\AutocompleteController::class, 'productTypes']);
                Route::get('/ac/media/books/{images}', [\App\Http\Controllers\Admin\AutocompleteController::class, 'mediaBooks']);
                Route::get('/ac/media/books', [\App\Http\Controllers\Admin\AutocompleteController::class, 'mediaBooks']);
        });

require __DIR__.'/admin/auth.php';
