<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use App\Models\User;
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
    public function showWeekend(Request $request)
    {
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));
        $user = User::where('id', $request->user_id)->get();
        $check = Record::where('user_id', $request->user_id)->where('is_taken', 1)->whereDate('lunch_dates', '=', $date)->orderby('lunch_dates', 'DESC')->first();
        $is_taken=1;

        if (!$check) {
            $is_taken = 0;
        }
        if ($user) {

            $offDay = LunchDate::all();
            return response(['offday' => $offDay, 'is_taken' => $is_taken], 200);

        } else {
            return response(["message" => "something went wrong"], 404);
        }
    }
}
