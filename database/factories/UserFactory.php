<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$5GSm8YpIuQqU7OpGREJWv.EY7OoofkVCnoYcx87Zv8nb9qqDVXGcG', // password@123
        'remember_token' => null,
        'blocked_at' => $faker->boolean(90) ? today() : null
    ];
});
