<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $guarded = [];
    protected $casts = [
        'sent_at'=>'datetime',
    ];
    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function discount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function notifications(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Notification::class,'object');
    }

    public function notifications_read(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Notification::class,'object')->whereNotNull('read_at');
    }

    public function getNotificationsAvgAttribute($value): int|string
    {
        if($this->notifications()->count()==0) return 0;
        return number_format(($this->notifications_readed()->count()/$this->notifications()->count())*100,2);
    }
}
