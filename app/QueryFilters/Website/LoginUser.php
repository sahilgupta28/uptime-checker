<?php

namespace App\QueryFilters\Website;

use App\QueryFilters\Filter;

class LoginUser extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('user_id', request('user_id') ?? auth()->user()->id);
    }
}
