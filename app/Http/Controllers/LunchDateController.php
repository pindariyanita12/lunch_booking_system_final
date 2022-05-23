<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
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
                return redirect('/admindashboard')->with('message', 'Date Added Successfully');
            } else {
                return redirect('/admindashboard')->with('message', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect('/admindashboard')->with('message', 'Duplicate Entry');
        }
    }

    //shows all off days
    public function showWeekend(Request $req)
    {
        $user = User::where('email', $req->mail)->get();
        if ($user) {

            $offDay = LunchDate::all();

            return response($offDay, 200);

        } else {

            return response(["message" => "something went wrong"], 404);

        }
    }
}
