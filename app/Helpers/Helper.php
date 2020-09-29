<?php

namespace App\Helpers;

class Helper
{
    public static function calculatePercentage($total_amount, $calculated_amount)
    {
        if ($total_amount == 0) {
            return 100;
        }
        return  round(
            (
                $calculated_amount / $total_amount
            ) * 100,
            config('constants.ROUND')
        );
    }
}
