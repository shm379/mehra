<?php

namespace App\Services\Admin;

use App\Models\Import;

class ImportService
{

    public function __construct()
    {
    }

    public function imported($wp_id , $created_id, $created_type)
    {
        Import::query()->create([
            'wp_id'=> $created_id,
            'model_id'=> $created_id,
            'model_type'=> $created_type
        ]);
    }
    public function isImportedBefore($wp_id , $created_type)
    {
        return Import::query()->where('wp_id',$wp_id)->where('model_type',$created_type)->exists();
    }
}
