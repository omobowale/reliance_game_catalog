<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Player;
use App\Game;
use App\Version;
use App\Other;
use App\GamePlay;
use App\GamePlayer;

class GamePlaysSeeder extends Seeder
{
    public $player_id;
    public $version_id;
    public $other_id;
    public $date_played;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 3835 days of gaming;
        // for($i = 0; $i < 3835; $i++){
        //     $this->generateForDay($i);
        // }

        // 100 days of gaming test;
        for($i = 0; $i < 100; $i++){
            $this->generateForDay($i);
        }

    }

    public function generateForDay($i){
        $faker = Faker::create();
        $randomNumberOfPlays = $faker->numberBetween($min = 1, $max = Player::count());
        //
        $index = 0;
        while(true){
            if($index == $randomNumberOfPlays){
                break;
            }

            $this->generateGamePlay($i);
            if($this->insertedDetails()){
                $index++;
            }

        }
        
    }

    public function generateGamePlay($day){
        $faker = Faker::create();
        $this->player_id = $faker->numberBetween($min = 1, $max = Player::count());
        $this->version_id = $faker->numberBetween($min = 1, $max = Version::count());
        $this->other_id = $faker->numberBetween($min = 0, $max = Player::count());
        $this->date_played = date('Y-m-d', strtotime("-" . $day . " days"));
    }

    public function notPlayedBeforeAdded($play_date, $added_date){
        if($added_date < $play_date){
            return true;
        }

        return false;
    }

    public function getGameDate($id){
        return Version::find($id)->date_added;
    }

    public function insertedDetails(){
        //check first that a game is not played before it was added
        if($this->notPlayedBeforeAdded($this->date_played, $this->getGameDate($this->version_id))){

            //check if player played alone
            if($this->other_id == 0 || $this->player_id == $this->other_id){
                //if they played alone, insert if not exist on the database
                //where other_id = 0, player_id and version_id and date_played
                $gameplay = GamePlay::firstOrCreate(["other_id" => 0, "player_id" => $this->player_id, "version_id" => $this->version_id, "date_played" => $this->date_played]);
                
                if($gameplay->wasRecentlyCreated){
                    $otherPlayer = Other::create(["game_play_id" => $gameplay->id, "player_id" => 0]);
                    return true;
                }
            }

            //if they didn't play alone, make sure the number of other players is not more than 3
            //also check that the other_id player has the same version of game
            else if($this->other_id > 0 && $this->hasGame($this->other_id, $this->version_id)){
                $count = GamePlay::where("player_id", $this->player_id)->where("version_id", $this->version_id)->where("date_played", $this->date_played)->count();
                if($count < 3){
                    $gameplay = GamePlay::firstOrCreate(["other_id" => $this->other_id, "player_id" => $this->player_id, "version_id" => $this->version_id, "date_played" => $this->date_played]);
                    if($gameplay->wasRecentlyCreated){
                        //add to the other table
                        $otherPlayer = Other::create(["game_play_id" => $gameplay->id, "player_id" => $this->other_id]);
                        return true;
                    }
                }
            }

        }

        return false;
    }

    public function hasGame($p_id, $g_id){
        $count = GamePlayer::where('player_id', $p_id)->where('version_id', $g_id)->count();
        if($count > 0){
            return true;
        }

        return false;
    }

}
