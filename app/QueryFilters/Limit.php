<?php

namespace App\QueryFilters;

use Closure;

class Limit extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->limit(request('limit') ?? config('constants.DEFAULT.LIMIT'));
    }
}
