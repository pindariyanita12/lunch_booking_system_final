<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use Illuminate\Http\Request;

class LunchDateController extends Controller
{

    //update offdays
    public function addWeekend(Request $request)
    {
        LunchDate::truncate();
        $arr = explode(",", $request->dates);

        $i = 0;
        try {
            while ($i < count($arr)) {
                try {
                    LunchDate::create(['weekend' => $arr[$i]]);
                    $i++;

                } catch (\Exception $e) {
                    return redirect('offday')->with('msg', 'Something went wrong');
                }
            }
            $check = LunchDate::all();
            if ($check) {
                return redirect('/offday')->with('message', 'Date Added Successfully');
            } else {
                return redirect('/offday')->with('message', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect('/offday')->with('message', 'Duplicate Entry');
        }
    }

    //shows all off days
    public function showWeekend()
    {

        $offDays = LunchDate::all()->pluck('weekend');
        $newdate = [];
        foreach($offDays as $key => $date){
            $newdate[$key]['title'] = "off-Day";
            $newdate[$key]['start'] = $date;
        }

    return view('user.offday', ['offDays' =>  json_encode($newdate)]);
    }
}
