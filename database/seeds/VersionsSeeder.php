<?php

use Illuminate\Database\Seeder;
use App\Game;
use App\Version;

class VersionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $versions = [2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020];

        for($i = 1; $i <= Game::count(); $i++){
            $game_id = Game::find($i)->id;
            for($j = 0; $j < count($versions); $j++){
                $this->createAndStoreVersions($game_id, $versions[$j], $this->convertVersionToDateAdded($versions[$j]));
            }    
        }
    }


    public function createAndStoreVersions($game_id, $version, $date){
        $newversion = new Version;
        $newversion->game_id = $game_id;
        $newversion->version = $version;
        $newversion->date_added = $date;
        $newversion->save();
    }

    public function convertVersionToDateAdded($version){
        return date("Y-m-d", mktime(0, 0, 0, 1, 1, $version));
    }
}
