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
        Schema::create('product_comment_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_attribute_id');
            $table->unsignedBigInteger('comment_id');
            $table->string('rate');
            $table->boolean('selectable')->default(1);
            $table->timestamps();
            $table->foreign('comment_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('comment_attribute_id')
                ->references('id')
                ->on('comment_attributes')
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
        Schema::dropIfExists('product_comment_attributes');
    }
};
