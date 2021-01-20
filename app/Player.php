<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //Override the timestamps column names
    const CREATED_AT = "date_joined";

    //A player could own many games
    public function games(){
        return $this->belongsToMany('App\Game', 'game_players');
    } 


}
