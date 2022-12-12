<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
