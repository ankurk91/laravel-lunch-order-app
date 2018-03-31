<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserProfile::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'primary_phone' => $faker->randomNumber(5, true) . $faker->randomNumber(5, true)
    ];
});
