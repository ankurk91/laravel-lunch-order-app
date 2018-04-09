<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * Compare given route with current route and return output if they match.
 *
 * @param $route String
 * @param string $output
 * @return null|string
 */
function isActiveRoute($route, $output = "active")
{
    return (Route::currentRouteName() === $route) ? $output : null;
}

/**
 * Convert a number into readable currency format
 *
 * @param $number
 * @param string $sign
 * @return string
 */
function money($number, $sign = '₹')
{
    return $sign . number_format((float)$number, 2, '.', ',');
}


function monthsWithNames()
{
    $months = [];

    for ($m = 1; $m <= 12; ++$m) {
        $months[$m] = date('F', mktime(0, 0, 0, $m, 1));
    }

    return $months;
}
