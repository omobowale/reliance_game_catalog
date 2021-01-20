<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Player;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Player::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name, 
        'email' => $faker->unique()->safeEmail,
        'nickname' => $faker->name,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'last_login' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')->format("Y-m-d H:i:s"),
        'date_joined' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now')->format("Y-m-d H:i:s"),
    ];
});
