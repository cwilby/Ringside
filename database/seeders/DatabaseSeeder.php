<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $dateToStart = Carbon::now()->subYears(5);

        $this->call(MatchTypesTableSeeder::class);
        $this->call(MatchDecisionsTableSeeder::class);
        $this->call(VenuesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(TitlesTableSeeder::class, false, $dateToStart->copy());
        // $this->call(WrestlersTableSeeder::class, false, $dateToStart->copy());
        // $this->call(TagTeamsTableSeeder::class, false, $dateToStart->copy());
        // $this->call(ManagersTableSeeder::class, false, $dateToStart->copy());
        // $this->call(RefereesTableSeeder::class, false, $dateToStart->copy());
        // $this->call(StablesTableSeeder::class, false, $dateToStart->copy());
        // $this->call(EventsTableSeeder::class);
    }
}
