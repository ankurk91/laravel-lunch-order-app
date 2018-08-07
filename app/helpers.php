<?php

/**
 * Compare given route with current route and return output if they match.
 *
 * @param $pattern String
 * @param string $output
 * @return null|string
 */
function active_route($pattern, $output = "active")
{
    return (\Illuminate\Support\Facades\Route::is($pattern)) ? $output : null;
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

/**
 * Get months names with numbers
 *
 * @param int $from
 * @param int $to
 * @return array
 */
function months_with_names($from = 1, $to = 12)
{
    $months = [];

    for ($m = $from; $m <= $to; ++$m) {
        $months[$m] = date('F', mktime(0, 0, 0, $m, 1));
    }

    return $months;
}

/**
 * Return contents of svg file
 *
 * @param $filename
 * @return \Illuminate\Support\HtmlString
 */
function svg($filename)
{
    return new \Illuminate\Support\HtmlString(
        file_get_contents(resource_path("images/{$filename}.svg"))
    );
}
