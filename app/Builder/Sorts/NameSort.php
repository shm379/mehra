<?php

namespace App\Builder\Sorts;

use \Illuminate\Database\Eloquent\Builder;

class NameSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
//        ->orWhere(DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%".$search."%")

        $query->orderByRaw("LENGTH(`{$property}`) {$direction}");
    }
}
