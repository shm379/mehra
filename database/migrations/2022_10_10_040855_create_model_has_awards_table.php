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
        Schema::create('model_has_awards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('award_id');
            $table->morphs('model');
            $table->timestamps();

            $table->foreign('award_id')
                ->references('id')
                ->on('awards')
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
        Schema::dropIfExists('model_has_awards');
    }
};
