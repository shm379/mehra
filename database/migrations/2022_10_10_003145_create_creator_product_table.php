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
        Schema::create('creator_product', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('creator_creator_type_id')->unique();
            $table->unique(['creator_id','product_id']);
            $table->foreign('creator_id')
                ->references('id')
                ->on('creators')
                ->onDelete('cascade');
            $table->foreign('creator_creator_type_id')
                ->references('id')
                ->on('creator_creator_types')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('creator_products');
    }
};
