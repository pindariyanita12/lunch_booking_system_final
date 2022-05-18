<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin dashboard
    public function show(Request $request)
    {
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));

        $dates = Record::with('user')->whereDate('created_at', '=', $date)->get();
        $guests = $dates->sum('guests');
        $avdate = date('Y-m-d', strtotime('+1 Day'));

        $available_date = $avdate;
        $lunchdates = LunchDate::select('weekend')->pluck('weekend');

        $i = 0;

        while ($i < sizeof($lunchdates)) {

            if ($lunchdates[$i] == $available_date) {

                $available_date = date('Y-m-d', strtotime($lunchdates[$i] . ' +1 day'));

            }
            $i++;

        }

        $lunched = $dates->where('is_taken', 1)->count('is_taken');
        // return view('admin.admindashboard', ['records' => $dates, 'guests' => $guests, 'totaltaken' => $lunched, 'avdate' => $avdate2]);

        if ($request->ajax()) {

            return datatables()->of(Record::with('user')->get())
                ->editColumn('userempid', function ($order) {
                    return empty($order->user->emp_id) ? "NA" : $order->user->emp_id;
                })
                ->editColumn('username', function ($order) {
                    return empty($order->user->name) ? "NA" : $order->user->name;
                })
                ->make(true);
        }
        return view('admin.admindashboard', ['records' => $dates, 'guests' => $guests, 'totaltaken' => $lunched, 'avdate' => $available_date]);

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
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));

        $dates = Record::with('user')->whereDate('created_at', '=', $date)->get();
        $guests = $dates->sum('guests');
        $avdate = date('Y-m-d', strtotime('+1 Day'));

        $available_date = $avdate;
        $lunchdates = LunchDate::select('weekend')->pluck('weekend');

        $i = 0;

        while ($i < sizeof($lunchdates)) {

            if ($lunchdates[$i] == $available_date) {

                $available_date = date('Y-m-d', strtotime($lunchdates[$i] . ' +1 day'));

            }
            $i++;

        }

        $lunched = $dates->where('is_taken', 1)->count('is_taken');
        // return view('admin.admindashboard', ['records' => $dates, 'guests' => $guests, 'totaltaken' => $lunched, 'avdate' => $avdate2]);

        if ($request->ajax()) {

            return datatables()->of(Record::with('user')->get())
                ->editColumn('userempid', function ($order) {
                    return empty($order->user->emp_id) ? "NA" : $order->user->emp_id;
                })
                ->editColumn('username', function ($order) {
                    return empty($order->user->name) ? "NA" : $order->user->name;
                })

                ->make(true);
        }
        $date = date('Y-m-d', strtotime($request->date));
        $record = Record::with('user')->whereDate('created_at', '=', $date)->get();
        $guests = $record->sum('guests');
        return view('admin.dateWiserecord', ['records' => $record, 'guests' => $guests, 'lunched' => $lunched]);

    }

    //monthwise records
    public function monthWise(Request $request,$id)
    {
        // dd($request->all());
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));

        $record = Record::with('user')->whereMonth('created_at', '=', $id)->get();
        $guests = $record->sum('guests');
        $avdate = date('Y-m-d', strtotime('+1 Day'));

        $available_date = $avdate;
        $lunchdates = LunchDate::select('weekend')->pluck('weekend');

        $i = 0;

        while ($i < sizeof($lunchdates)) {

            if ($lunchdates[$i] == $available_date) {

                $available_date = date('Y-m-d', strtotime($lunchdates[$i] . ' +1 day'));

            }
            $i++;

        }

        $lunched = $record->where('is_taken', 1)->count('is_taken');
        // return view('admin.admindashboard', ['records' => $dates, 'guests' => $guests, 'totaltaken' => $lunched, 'avdate' => $avdate2]);

        if ($request->ajax()) {

            return datatables()->of(Record::with('user')->get())
                ->editColumn('userempid', function ($order) {
                    return empty($order->user->emp_id) ? "NA" : $order->user->emp_id;
                })
                ->editColumn('username', function ($order) {
                    return empty($order->user->name) ? "NA" : $order->user->name;
                })

                ->make(true);
        }
        // $date = date('Y-m-d', strtotime($request->date));

        return view('admin.monthWiserecord', ['records' => $record, 'guests' => $guests]);
    }

}
