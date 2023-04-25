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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('notifier_id');
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('object_id');
            $table->string('object_type', 31);
            $table->enum('activity_type', \App\Enums\NotificationActivityType::asArray());
            $table->text('message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['object_id', 'object_type']);
            $table->foreign('actor_id')->references('id')->on('users');
            $table->foreign('notifier_id')->references('id')->on('users');
            $table->foreign('message_id')->references('id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
