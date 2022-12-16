<?php

namespace App\Models;

use App\Enums\ProductStructure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWishlist extends Model
{
    public function model(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function product(): BelongsTo
    {
        if($this->model()->first()->structure == ProductStructure::BOOK)
            return $this->belongsTo(Book::class);

        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
