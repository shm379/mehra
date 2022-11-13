<?php

namespace App\Models;

use App\Enums\OrderNoteStatus;
use App\Enums\OrderNoteType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNote extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
      'type' => OrderNoteType::class,
      'status' => OrderNoteStatus::class
    ];
}
