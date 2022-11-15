<?php

namespace App\Models;

use App\Enums\UserFollowType;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    protected $primaryKey = ['user_id', 'follow_id','type'];
    public $incrementing = false;
    protected $appends = ['type'];
    use HasFactory;

    public function getTypeAttribute()
    {
        return UserFollowType::getDescription((int)$this->attributes['type']);
    }
}
