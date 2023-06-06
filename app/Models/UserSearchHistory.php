<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSearchHistory extends Pivot
{
    use HasFactory;
    protected $table = 'user_search_histories';
    protected $guarded = [];
}
