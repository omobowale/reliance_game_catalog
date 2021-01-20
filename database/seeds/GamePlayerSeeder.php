<?php

use Illuminate\Database\Seeder;
use App\Player;
use App\Game;
use App\Version;
use App\GamePlayer;
use Faker\Factory as Faker;

class GamePlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->generate();
    }


    public function generate(){
        //loop through the players table
        for($i = 1; $i <= Player::count(); $i++){
            $player_id = Player::find($i)->id;
            $this->fetchVersionsAndStore($player_id);
        }
    }

    public function fetchVersionsAndStore($player_id){
        //generate random number between 1 and 10 as a test data
        $faker = Faker::create();
        $randomNumberVersion = $faker->numberBetween($min = 1, $max = 10);

        for($i = 1; $i <= Game::count(); $i++){
            $game_id = Game::find($i)->id;
            foreach($this->fetchVersions($game_id, $randomNumberVersion) as $version){
                $this->storeGamePlayerAndVersion($player_id, $game_id, $version->id);
            } 
           
        }
    }

    public function storeGamePlayerAndVersion($player_id, $game_id, $version_id){
        $gameplayerversion = new GamePlayer;
        $gameplayerversion->player_id = $player_id;
        $gameplayerversion->game_id = $game_id;
        $gameplayerversion->version_id = $version_id;
        $gameplayerversion->save();
    }


    public function fetchVersions($game_id, $limit){

        return Version::where('game_id', $game_id)->limit($limit)->get();

    }


}
