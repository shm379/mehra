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
        Schema::create('order_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->text('note');
            $table->enum('status',\App\Enums\OrderNoteStatus::getKeys());
            $table->enum('type',\App\Enums\OrderNoteType::asArray());

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('order_notes');
    }
};
