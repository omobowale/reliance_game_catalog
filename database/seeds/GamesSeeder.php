<?php

use Illuminate\Database\Seeder;
use App\Game;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = ["Call of Duty", "Mortal Kombat", "FIFA", "Just Cause", "Apex Legend"];

        for($i = 0; $i < count($games); $i++){
            $this->createAndStoreGame($games[$i]);
        }
    }

    public function createAndStoreGame($game){
        $newgame = new Game;
        $newgame->name = $game;
        $newgame->save();
    }

   
}
