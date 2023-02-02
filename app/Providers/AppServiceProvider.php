<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
//use Optix\Media\MediaServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        Model::preventLazyLoading(! app()->isProduction());
//        $this->app->register(MediaServiceProvider::class);
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Relation::morphMap(config('morphmap'));
        if($this->app->environment('production')) {
            $this->app['request']->server->set('HTTPS','on');
            URL::forceScheme('https');
        }
//        $this->app->singleton(CartService::class, function ($app) {
//            return new CartService();
//        });
    }
}
