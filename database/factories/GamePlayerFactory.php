<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use App\Player;
use App\GamePlayer;
use Faker\Generator as Faker;

$factory->define(GamePlayer::class, function (Faker $faker) {
    return [
        'player_id' => $faker->numberBetween($min = 1, $max = countPlayers()),
        'game_id' => $faker->numberBetween($min = 1, $max = countGames()),
    ];
});

function countGames(){
    return Game::count();
}

function countPlayers(){
    return Player::count();
}

function generateGamePlayer($game, $numberOfVersions){
    
}