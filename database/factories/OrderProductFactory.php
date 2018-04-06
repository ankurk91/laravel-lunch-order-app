<?php

use Faker\Generator as Faker;

$factory->define(App\Models\OrderProduct::class, function (Faker $faker) {
    return [
        'quantity' => rand(1, 5),
        'unit_price' => rand(15, 50),
    ];
});
