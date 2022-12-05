<?php

namespace App\Listeners;

use \Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateEnums
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  MigrationsEnded  $event
     * @return void
     */
    public function handle(MigrationsEnded $event)
    {
        dd($event);
        $productTypes = implode(',',\App\Enums\ProductType::asArray());
        \DB::statement("ALTER TABLE `products` CHANGE `type` ENUM($productTypes) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL';");
    }
}
