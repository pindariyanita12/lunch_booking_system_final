<?php

namespace Database\Seeders;

use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $period = CarbonPeriod::create('2022-01-01', '2022-12-31');
        $sat_sun_day = [];
        // Iterate over the period
        foreach ($period as $date) 
        {
            if ($date->isSaturday() == true || $date->isSunday() == true)
            {
            $sat_sun_day[] = $date->format('Y-m-d');
            }
        }
       for ($i = 0; $i < sizeof($sat_sun_day); $i++)
        {
            DB::table('lunch_dates')->insert([
                'weekend' => $sat_sun_day[$i],
            ]);
       }
    }
}
