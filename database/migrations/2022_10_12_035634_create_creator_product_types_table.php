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
        Schema::create('creator_product_types', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id');
            $table->integer('product_type');

            $table->unique(['creator_id','product_type']);

            $table->foreign('creator_id')
                ->references('id')
                ->on('creators')
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
        Schema::dropIfExists('creator_product_types');
    }
};
