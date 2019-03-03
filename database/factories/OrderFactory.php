<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Models\Order::class, function (Faker $faker) {

    $status = config('project.order_status');

    return [
        'customer_notes' => rand(0, 1) ? $faker->text(rand(50, 150)) : null,
        'staff_notes' => rand(0, 1) ? $faker->text(rand(50, 150)) : null,
        'status' => Arr::random($status),
        'for_date' => today()->toDateString(),
    ];
});
