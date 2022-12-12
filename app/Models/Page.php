<?php

namespace App\Models;

use App\Traits\LogsUserView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use LogsUserView;
    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
