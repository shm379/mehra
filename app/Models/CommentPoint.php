<?php

namespace App\Models;

use App\Enums\CommentPointStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentPoint extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'type' => CommentPointStatus::class
    ];
}
