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
<<<<<<< Updated upstream
            Schema::drop('attribute_value_product');
=======
        // Schema::drop('attribute_value_product');
>>>>>>> Stashed changes
        Schema::create('attribute_value_product', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_value_id');
            $table->unsignedBigInteger('product_id');
            $table->unique(['attribute_value_id', 'product_id']);
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('attribute_value_id')
                ->references('id')
                ->on('attribute_values')
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
        Schema::dropIfExists('attribute_products');
    }
};
