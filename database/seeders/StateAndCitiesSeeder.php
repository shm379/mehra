<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StateAndCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tapinArr = [];
        $hasTapinFile = File::exists(public_path('data/tapin.json'));
        if($hasTapinFile){
            $states = json_decode(File::get(public_path('data/tapin.json')),true);
            foreach ($states as $stateId => $state) {
                $stateDB = State::query()->create(
                    [
                        'id'=> $stateId,
                        'title'=> $state['title'],
                    ]
                );
                if(isset($state['cities'])) {
                    foreach ($state['cities'] as $cityId => $cityTitle) {
                        City::query()->create(
                            [
                                'id' => $cityId,
                                'state_id' => $stateId,
                                'title' => $cityTitle
                            ]
                        );
                    }
                }
            }
        }

    }
}
