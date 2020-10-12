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

    public static function CheckNotificationStatus($notification_key, $notification_start_at)
    {
        if ($notification_key == 0) {
            return true;
        }
        $fibo_sum = self::getFibonacciSum($notification_key + 1);
        $next_notification = date(
            config('constants.DATE_TIME_FORMAT'),
            strtotime('+' . $fibo_sum . ' minutes', $notification_start_at)
        );

        if($next_notification == date(config('constants.DATE_TIME_FORMAT')))
        {
            return true;
        }
        return false;
    }

    public static function getFibonacciSum($notification_key)
    {
        $num1 = $sum = 0;
        $num2 = 1;

        $counter = 0;
        for ($counter = 0; $counter < $notification_key; $counter++) {
            $sum = $sum + $num1 ;
            $num3 = $num2 + $num1;
            $num1 = $num2;
            $num2 = $num3;
        }
        return $sum;
    }
}
