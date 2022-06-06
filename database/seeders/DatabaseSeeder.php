<?php

namespace Database\Seeders;

use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Database\Seeders\OffdaySeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\LunchTakenSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        //
        $this->call([
            LunchTakenSeeder::class,OffdaySeeder::class
        ]);
    }
}
