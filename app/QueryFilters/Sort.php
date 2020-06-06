<?php

namespace App\QueryFilters;

class Sort extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderby('id', request('sort') ?? config('constants.DEFAULT.SORT'));
    }
}
