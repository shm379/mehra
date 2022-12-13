<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->belongsToMany(Comment::class,'comment_rates');
    }
}
