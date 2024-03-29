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
        Schema::create('model_has_media', function (Blueprint $table) {
            $table->unsignedBigInteger('media_id');
            $table->morphs('model');
            $table->string('tag')->nullable();
            $table->string('collection_name');
            $table->unsignedBigInteger("order");
            $table->foreign('media_id')
                ->references('id')
                ->on('media')
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
        Schema::dropIfExists('model_has_media');
    }
};
