<?php

use Faker\Generator as Faker;

$factory->define(App\Personal::class, function (Faker $faker) {
    return [
        'p00' => $faker->unique()->randomNumber($nbDigits = 6, $strict = true),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail
    ];
});
