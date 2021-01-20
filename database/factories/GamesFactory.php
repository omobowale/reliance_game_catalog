<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'version' => 'Version: ' . $faker->numberBetween($min = 1, $max = 10),
        'date_added' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now')->format("Y-m-d"),
    ];
});
