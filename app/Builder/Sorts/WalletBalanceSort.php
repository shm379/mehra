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
        $query->with(['wallet'=>function($wallet) use ($direction,$query){
            $query->orderBy('wallet.balance',$direction);
        }]);
    }
}
