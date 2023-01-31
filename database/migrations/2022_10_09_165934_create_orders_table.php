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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->unsignedDouble('total_discount_amount',10,0)->nullable();
            $table->unsignedDouble('total_main_price',10,0)->nullable(); // (sum of all order items main prices)
            $table->unsignedDouble('total_price',10,0); // (sum of all order items prices)
            $table->unsignedDouble('total_shipping_price',10,0)->nullable();
            $table->unsignedDouble('total_after_discount',10,0)->nullable(); // (total_price - discount_amount)
            $table->unsignedDouble('total_final_price',10,0); // (total_after_discount + shipping_price) Or (total_price + shipping_price)
            $table->unsignedDouble('total_vat',10,0)->nullable();
            $table->timestamp('date')->default(now());
            $table->enum('status', \App\Enums\OrderStatus::asArray());
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('shipping_id')
                ->references('id')
                ->on('shippings')
                ->onDelete('cascade');
            $table->foreign('address_id')
                ->references('id')
                ->on('user_addresses')
                ->onDelete('cascade');
            $table->foreign('discount_id')
                ->references('id')
                ->on('discounts')
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
        Schema::dropIfExists('orders');
    }
};
