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
        Schema::create('creator_type_series', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_type_id');
            $table->unsignedBigInteger('series_id');
            $table->unique(['creator_type_id','series_id']);

            $table->foreign('creator_type_id')
                ->references('id')
                ->on('creator_types')
                ->onDelete('cascade');

            $table->foreign('series_id')
                ->references('id')
                ->on('series')
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
        Schema::dropIfExists('creator_series');
    }
};
