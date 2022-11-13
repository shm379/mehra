<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_templates')->insertGetId([
            'name'=>'قالب معمولی',
            'schema'=>json_encode(['blocks'=>['block'=>[]]])
        ]);
    }
}
