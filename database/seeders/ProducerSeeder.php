<?php

namespace Database\Seeders;

use App\Models\Producer;
use Database\Factories\ProducerFactory;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producer::factory()->count(100)->create();
    }
}
