<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profession::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence(3, false)
    ];
});
