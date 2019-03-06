<?php

use Faker\Generator as Faker;

$factory->define(App\History::class, function (Faker $faker) {
    return [
        'personal_id' => $faker->unique()->numberBetween($min = 1, $max = 100),
        'oficina_id' => $faker->numberBetween($min = 1, $max = 4),
        'date_rol_in' =>$faker->date($format = 'Y-m-d', $max = 'now')
    ];
});
