
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->boolean('is_virtual');
            $table->boolean('discount_applied')->default(0);
            $table->unsignedFloat('price_without_discount',10,0)->nullable();
            $table->unsignedFloat('price',10,0);
            $table->unsignedInteger('quantity');
            $table->unsignedDouble('total_price_without_discount',10,0)->nullable();
            $table->unsignedDouble('total_price',10,0);
            $table->morphs('line_item');
            $table->unique(['order_id','line_item_id','line_item_type']);
            $table->timestamps();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('order_products');
    }
};
