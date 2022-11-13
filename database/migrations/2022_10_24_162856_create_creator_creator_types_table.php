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
        Schema::create('creator_creator_types', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('creator_type_id');

            $table->unique(['creator_id','creator_type_id']);

            $table->foreign('creator_id')
                ->references('id')
                ->on('creators')
                ->onDelete('cascade');
            $table->foreign('creator_type_id')
                ->references('id')
                ->on('creator_types')
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
        Schema::dropIfExists('creator_creator_types');
    }
};
