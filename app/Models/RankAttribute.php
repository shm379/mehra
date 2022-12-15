<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankAttribute extends Model
{
    use HasFactory;
    public function attributes()
    {
        return $this->belongsToMany(RankAttribute::class,'ranks');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'ranks');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'ranks');
    }
    public function comments()
    {
        return $this->belongsToMany(Comment::class,'ranks');
    }
}
