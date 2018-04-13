<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserProfile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => rand(0, 1) ? $faker->lastName : null,
        'primary_phone' => $faker->randomNumber(5, true) . $faker->randomNumber(5, true)
    ];
});
