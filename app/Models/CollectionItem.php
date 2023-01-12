<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class CollectionItem extends MorphPivot
{
    use HasFactory;
    protected $table = 'collection_item';

    public function item()
    {
        return $this->morphTo();
    }
}
