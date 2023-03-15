<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Competition;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Competition::factory()
                   ->count(20)
                   ->hasAttached(
                       Player::factory()->count(3),
                       [
                           Model::CREATED_AT => Carbon::now(),
                           Model::UPDATED_AT => Carbon::now(),
                       ]
                   )
                   ->create();
    }
}
