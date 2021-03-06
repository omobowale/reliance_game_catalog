<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlayersSeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(VersionsSeeder::class);
        $this->call(GamePlayerSeeder::class);
        $this->call(GamePlaysSeeder::class);
    }
}
