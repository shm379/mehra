<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CreatorProduct extends Pivot
{
    protected $appends = [
        'creator_creator_type_id',
    ];

    public function getCreatorCreatorTypeIdAttribute()
    {
        $creator_type = CreatorType::query()->find($this->attributes['creator_creator_type_id']);

        if (!$creator_type) return null;

        return $creator_type;
    }
}
