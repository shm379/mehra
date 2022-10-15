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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->enum('type',\App\Enums\DiscountType::asArray());
            $table->string('code');
            $table->enum('creator_type',\App\Enums\DiscountCreatorType::asArray());
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->unsignedBigInteger('capacity')->default(1);
            $table->unsignedBigInteger('all_products')->default(0);
            $table->unsignedBigInteger('used_count')->default(0);
            $table->unsignedBigInteger('per_user')->default(1);
            $table->unsignedInteger('percent')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_active');
            $table->boolean('first_buy')->default(0);
            $table->boolean('limit_users')->default(0);
            $table->timestamp('expire_at');
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
        Schema::dropIfExists('discounts');
    }
};
