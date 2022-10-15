<?php

namespace App\Models;

use App\Observers\UserViewObserver;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserView extends Model
{
    use HasFactory;
    protected $guarded = [];
}
