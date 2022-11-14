<?php

namespace App\Builder\Sorts;


use \Illuminate\Database\Eloquent\Builder;

class WalletBalanceSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->selectRaw('users.*, wallets.id as wallet_id')
            ->join('users', 'wallets.user_id', '=', 'wallet.id')
            ->orderBy('wallet_id');
    }
}
