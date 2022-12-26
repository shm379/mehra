<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tables = [
        'announcements',
        'category_templates',
        'collections',
        'creators',
        'comment_rates',
        'comments',
        'products',
        'users',
        'discounts',
        'producers',
        'awards',
        'sliders',
        'questions',
        'pages',
        'attributes',
        'attribute_values',
        'categories',
        'volumes',
        'order_notes',
        'product_related',
        'wallet_histories',
        'product_groups',
        'messages',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('key')->nullable();
            $table->text('value')->nullable();
            $table->nullableMorphs('model');
            $table->unsignedBigInteger('order')->nullable();
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
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'admin_id')) {
                    $table->dropColumn('admin_id');
                    $table->dropForeign($tableName . '_' . 'admin_id_foreign');
                }
            });
        }
    }
};
