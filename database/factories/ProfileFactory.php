<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'location' => $faker->city,
        'about' => $faker->paragraph(4)
    ];
});
