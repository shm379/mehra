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
        Schema::create('creators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_type_id');
            $table->unsignedBigInteger('creator_category_id');
            $table->string('title');
            $table->string('slug');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('description');
            $table->unsignedSmallInteger('birthday');
            $table->string('nickname')->nullable();
            $table->timestamps();

            $table->foreign('creator_type_id')
                ->references('id')
                ->on('creator_types')
                ->onDelete('cascade');
            $table->foreign('creator_category_id')
                ->references('id')
                ->on('creator_categories')
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
        Schema::dropIfExists('creators');
    }
};
