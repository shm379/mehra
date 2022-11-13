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
        Schema::create('creator_awards', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('award_id');

            $table->foreign('creator_id')
                ->references('id')
                ->on('creators')
                ->onDelete('cascade');

            $table->foreign('award_id')
                ->references('id')
                ->on('awards')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creator_awards');
    }
};
