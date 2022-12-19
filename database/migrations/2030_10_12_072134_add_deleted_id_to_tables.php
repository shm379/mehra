<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tables = [
        'media',
        'user_views',
        'user_addresses',
        'announcements',
        'category_templates',
        'collections',
        'ranks',
        'rank_attributes',
        'comments',
        'products',
        'users',
        'orders',
        'order_items',
        'category_product',
        'categories',
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
        'product_groups',
        'messages',
        'stocks',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasColumn($table, 'deleted_at'))
            {
                Schema::table($table, function (Blueprint $table)
                {
                    $table->softDeletes();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }
    }
};
