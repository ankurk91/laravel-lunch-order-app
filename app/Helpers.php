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
