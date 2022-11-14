<?php

namespace App\Builder\Sorts;

use App\Models\User;
use App\Models\Wallet;
use \Illuminate\Database\Eloquent\Builder;

class WalletBalanceSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->orderBy(
            Wallet::select('balance')
            ->whereColumn('wallets.user_id','user_id')
            ->orderBy('balance',$direction)
        );
    }
}
