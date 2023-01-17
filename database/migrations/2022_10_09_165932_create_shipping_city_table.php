<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_city', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedFloat('price_per_mg')->nullable();
            $table->unsignedBigInteger('order')->default(1);
            $table->unsignedFloat('free_free',10,0)->nullable();
            $table->boolean('is_free')->default(0);
            $table->boolean('is_active')->default(1);
            $table->unique(['city_id','shipping_id','order']);

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->foreign('shipping_id')
                ->references('id')
                ->on('shippings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_products');
    }
};
