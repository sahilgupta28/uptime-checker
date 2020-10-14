<?php

namespace App\QueryFilters\Website;

use App\QueryFilters\Filter;

class TestLogs extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->with('testLogs');
    }
}
