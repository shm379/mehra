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
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->unsignedDouble('total_price_without_discount',10,0)->nullable();
            $table->unsignedDouble('total_price_without_sale_price',10,0)->nullable();
            $table->unsignedDouble('total_price_without_shipping',10,0)->nullable();
            $table->unsignedDouble('total_price',10,0);
            $table->unsignedDouble('vat',10,0)->nullable();
            $table->timestamp('date')->default(now());
            $table->enum('status', \App\Enums\OrderStatus::asArray());
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
