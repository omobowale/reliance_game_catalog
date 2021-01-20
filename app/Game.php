<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Version;
use App\Player;

class Game extends Model
{
    public $timestamps = false;

    //A game could be owned by many players
    public function players(){
        return $this->belongsToMany(Player::class);
    }

    //A game has many versions
    public function versions(){
        return $this->belongsTo(Version::class);
    }
    
}
