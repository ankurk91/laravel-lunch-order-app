<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Supplier::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => rand(0, 1) ? $faker->lastName : null,
        'email' => $faker->unique()->safeEmail,
        'primary_phone' => $faker->randomNumber(5, true) . $faker->randomNumber(5, true),
        'alternate_phone' => null,
        'address' => $faker->address,
        'created_by_user_id' => 1,
        'active' => $faker->boolean(70),
    ];
});
