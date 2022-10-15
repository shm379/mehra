<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserCity;
use App\Enums\UserGender;
use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\User::factory(10)->create();
        DB::table('users')->insertGetId([
            'first_name'=>'سیدحسین',
            'last_name'=>'موسوی',
            'email' => 'shm379@gmail.com',
            'mobile' => '9391727950',
            'password' => Hash::make('09391727950'),
            'gender' => UserGender::MALE,
            'type' => UserType::PERSON,
            'city' => UserCity::getKey(UserCity::QOM),
        ]);
        $this->call([
            AttributeSeeder::class,
        ]);


    }
}
