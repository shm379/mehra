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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedFloat('price_per_mg')->nullable();
            $table->unsignedFloat('fixed_cost',10,0)->nullable();
            $table->unsignedFloat('extra_cost',10,0)->nullable();
            $table->unsignedFloat('free_free',10,0)->nullable();
            $table->boolean('is_free')->default(0);
            $table->boolean('is_cod')->default(0);
            $table->enum('type',\App\Enums\ShippingType::asArray())->default(\App\Enums\ShippingType::MANUAL);
            $table->unsignedBigInteger('order')->default(1)->unique();
            $table->boolean('all_products')->default(0);
            $table->boolean('all_cities')->default(0);
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('shippings');
    }
};
