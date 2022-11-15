<?php

namespace App\Models;

use App\Enums\AwardType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'award_type'=> AwardType::class
    ];
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function parent()
    {
        return $this->belongsTo($this,'parent_id');
    }

    public function scopeProducers($query,$q=null)
    {
        $query->where('award_type',AwardType::AWARD);
        if(isset($q)){
            $query->where('title','LIKE', '%' . $q . '%');
        }
        return $query->get();
    }
}
