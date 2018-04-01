<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Detect Active Route
|--------------------------------------------------------------------------
|
| Compare given route with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function isActiveRoute($route, $output = "active")
{
    return (Route::currentRouteName() === $route) ? $output : null;
}
