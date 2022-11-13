<?php

namespace App\Models;

use App\Observers\UserViewObserver;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserView extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
}
