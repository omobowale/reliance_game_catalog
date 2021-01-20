<?php

use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // There are 10,000 players in the system.
        // factory(App\Player::class, 10000)->create();
        factory(App\Player::class, 100)->create();
    }

}