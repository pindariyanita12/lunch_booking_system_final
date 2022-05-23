<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    //admin dashboard
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $date = date("Y-m-d");
            $record = Record::with('user')->whereDate('created_at', '=', $date)->get();
            return datatables()->of($record)
                ->editColumn('userempid', function ($userdata) {
                    return empty($userdata->user->emp_id) ? "NA" : $userdata->user->emp_id;
                })
                ->editColumn('username', function ($userdata) {
                    return empty($userdata->user->name) ? "NA" : $userdata->user->name;
                })
                ->addColumn('action', function ($userdata) {
                    $actionBtn = '<a href="' . route('admin.admindashboard.destroy', $userdata->user->id) . '" class="btn btn-danger btn-sm" ><i class="fa fa-trash ">Delete</i></a>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.admindashboard');

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
        if ($request->ajax()) {
            $record = Record::with('user')->whereDate('created_at', '=', $request->date)->get();
            return datatables()->of($record)
                ->editColumn('userempid', function ($userdata) {
                    return empty($userdata->user->emp_id) ? "NA" : $userdata->user->emp_id;
                })
                ->editColumn('username', function ($userdata) {
                    return empty($userdata->user->name) ? "NA" : $userdata->user->name;
                })
                ->addColumn('action', function ($userdata) {
                    $actionBtn = '<a href="' . route('admin.admindashboard.destroy', $userdata->user->id) . '" class="btn btn-danger btn-sm" ><i class="fa fa-trash ">Delete</i></a>';
                    return $actionBtn;
                })
                ->make(true);
        }
        return view('admin.dateWiserecord');

    }

    //monthwise records
    public function monthWise(Request $request)
    {

        // dd($uniquerecord);
        if ($request->ajax()) {

            $uniquerecord = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.created_at', '=', date('Y'))->whereMonth('records.created_at', '=', $request->idis)->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get();

            return datatables()->of($uniquerecord)

                ->editColumn('userempid', function ($userdata) {
                    return empty($userdata->user->emp_id) ? "NA" : $userdata->user->emp_id;
                })
                ->editColumn('username', function ($userdata) {
                    return empty($userdata->user->name) ? "NA" : $userdata->user->name;
                })
                ->editColumn('uniquerecord', function ($userdata) {
                    return $userdata->uniquerecord;
                })
                ->addColumn('action', function ($userdata) {
                    $actionBtn = '<a href="' . route('admin.admindashboard.destroy', $userdata->id) . '" class="btn btn-danger btn-sm" ><i class="fa fa-trash ">Delete</i></a>';
                    return $actionBtn;
                })
                ->make(true);
        }

        return view('admin.monthWiserecord');
    }

    public function destroy(Request $request)
    {


        $record = Record::with('user')->where('user_id', $request->id)->get();
        if (count($record) > 1) {
            $record->each->delete();
            return redirect('/admindashboard');

        } else {
            $record = Record::with('user')->where('user_id', $request->id)->first();
            $record->delete();
            return redirect('/admindashboard');

        }

    }
}
