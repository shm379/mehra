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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('value')->nullable();
            $table->enum('section',\App\Enums\SettingSection::asArray());
            $table->string('title')->nullable();
            $table->unsignedBigInteger('order')->default(1);
            $table->string('model')->nullable();
            $table->text('where')->nullable();
            $table->text('with')->nullable();
            $table->string('color')->nullable();
            $table->boolean('multiselect')->nullable()->default(0);
            $table->unsignedSmallInteger('limit_number')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unique(['section','order']);
            $table->string('admin_title')->nullable();
            $table->string('admin_sub_title')->nullable();
            $table->enum('type',\App\Enums\SettingType::asArray());
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
        Schema::dropIfExists('settings');
    }
};
