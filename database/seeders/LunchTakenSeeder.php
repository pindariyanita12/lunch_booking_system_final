<?php

namespace Database\Seeders;

use App\Models\Record;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LunchTakenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $period = CarbonPeriod::create('2022-01-01', '2022-06-31');
        $work_day = [];
        // Iterate over the period
        foreach ($period as $date) {
            if ($date->isWeekday()) {
                $work_day[] = $date->format('Y-m-d');
            }

        }
        $userIDs = DB::table('users')->pluck('id');

        for ($i = 0; $i < sizeof($work_day); $i++) {

            for ($j = 0; $j < sizeof($userIDs); $j++)
            {
                Record::create([
                    "user_id" => $userIDs[$j],
                    "is_taken" => 1,
                    'lunch_dates' => $work_day[$i],
                ]);
            }
        }


    }
}
