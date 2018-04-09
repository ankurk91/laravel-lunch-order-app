<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text(rand(50, 150)),
        'unit_price' => rand(15, 50),
        'active' => $faker->boolean(70),
        'max_quantity' => $faker->numberBetween(1, 5),
    ];
});
