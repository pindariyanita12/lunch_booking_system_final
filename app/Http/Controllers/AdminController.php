<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin dashboard
    public function show()
    {
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));

        $dates = Record::with('user')->whereDate('created_at', '=', $date)->get();
        $guests = $dates->sum('guests');
        $avdate = date('Y-m-d', strtotime('+1 Day'));

        $avdate2 = $avdate;
        $lunchdates = LunchDate::select('weekend')->pluck('weekend');

        $i = 0;

        while ($i < sizeof($lunchdates)) {

            if ($lunchdates[$i] == $avdate2) {

                $avdate2 = date('Y-m-d', strtotime($lunchdates[$i] . ' +1 day'));

            }
            $i++;

        }
        $lunched = $dates->where('is_taken', 1)->count('is_taken');
        return view('admin.admindashboard', ['records' => $dates, 'guests' => $guests, 'totaltaken' => $lunched, 'avdate' => $avdate2]);
    }

    //off days for admin
    public function offday()
    {
        $dates = LunchDate::all();
        $d = "";
        foreach ($dates as $date) {
            $d = $d . $date->weekend . ',';
        }
        return view('admin.offday', ['dates' => $d]);
    }

    //Datewise records of users
    public function dateWise(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $record = Record::with('user')->whereDate('created_at', '=', $date)->get();
        $guests = $record->sum('guests');
        return view('admin.dateWiserecord', ['records' => $record, 'guests' => $guests]);

    }

    //monthwise records
    public function monthWise($id)
    {
        $record = Record::with('user')->whereMonth('created_at', '=', $id)->get();
        $guests = $record->sum('guests');
        return view('admin.monthWiserecord', ['records' => $record, 'guests' => $guests]);
    }

}
