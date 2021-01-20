<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;

class Version extends Model
{
    //
    public $timestamps = false;


    //A version belongs to a game
    public function game(){
        return $this->belongsTo(Game::class);
    }
}
