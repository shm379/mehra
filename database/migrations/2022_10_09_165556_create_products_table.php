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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('volume_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sub_title')->nullable();
            $table->text('description');
            $table->text('excerpt')->nullable();
            $table->text('summary')->nullable();
            $table->unsignedFloat('price',10);
            $table->unsignedFloat('sale_price',10)->nullable();
            $table->unsignedDouble('vat')->nullable();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->enum('product_structure',\App\Enums\ProductStructure::asArray());
            $table->enum('product_type',\App\Enums\ProductType::asArray());
            $table->unsignedBigInteger('order');
            $table->integer('min_purchases_per_user')->default(1);
            $table->integer('max_purchases_per_user')->default(1);
            $table->boolean('is_virtual')->default(0);
            $table->boolean('is_available');
            $table->unsignedInteger('in_stock_count')->default(1);
            $table->boolean('is_active');
            $table->timestamps();
            $table->unique(['order','volume_id']);
            $table->foreign('producer_id')
                ->references('id')
                ->on('producers')
                ->onDelete('cascade');
            $table->foreign('volume_id')
                ->references('id')
                ->on('volumes')
                ->onDelete('cascade');
            $table->foreign('parent_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('products');
    }
};
