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
        'ranks',
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
        'settings',
        'shippings',
        'shipping_product',
        'shipping_product_type',
        'shipping_city',
        'orders',
        'order_items',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table)  use ($tableName) {
                if (!Schema::hasColumn($tableName, 'admin_id')) {
                    $table->unsignedBigInteger('admin_id')->nullable();
                    $table->foreign('admin_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use($tableName) {
                if (!Schema::hasColumn($tableName, 'admin_id')) {
                    $table->dropColumn('admin_id');
                    $table->dropForeign('admin_id');
                }
            });
        }
    }
};
