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
        Schema::create('shipping_product_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_id');
            $table->enum('product_type',\App\Enums\ProductType::asArray());
            $table->unsignedFloat('price_per_mg')->nullable();
            $table->unsignedBigInteger('order')->default(1)->unique();
            $table->unsignedFloat('free_free',10,0)->nullable();
            $table->boolean('is_free')->default(0);
            $table->boolean('is_active')->default(1);
            $table->unique(['shipping_id']);

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
