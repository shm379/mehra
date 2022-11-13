<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        "notifier_id",
        "actor_id",
        "object_id",
        "object_type",
        "activity_type",
        "message",
        "sent_at",
        'read_at',
    ];

    protected $casts = [
      'sent_at'=>'datetime',
      'read_at'=>'datetime',
    ];

    protected $appends = ['is_read'];

    public function actor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function object(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function getIsReadAttribute(): int
    {
        return isset($this->read_at) ? 1 : 0;
    }
}
