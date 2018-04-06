<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Order::class, function (Faker $faker) {

    $status = ['pending', 'completed'];

    return [
        'customer_notes' => rand(0, 1) ? $faker->text(rand(50, 150)) : null,
        'staff_notes' => rand(0, 1) ? $faker->text(rand(50, 150)) : null,
        'status' => array_random($status),
    ];
});
