<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Html\Button;

class AdminController extends Controller
{

    public function lang($lang)
    {

        if (array_key_exists($lang, Config::get('app.languages'))) {
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }

    //admin dashboard
    public function show(Request $request)
    {
        if ($request->all() == null) {
            $dateis = date('Y-m-d');
        } else {
        $dateis = $request->date;
        }
        $uniquerecord = Record::select(DB::raw('DISTINCT Date(lunch_dates) as lunchdate,count(is_taken) as totaldishes'))->whereYear('lunch_dates', '=', date('Y'))->whereMonth('lunch_dates', date('m'))->groupBy('lunchdate')->get();

        $totalmonthlydishes = $uniquerecord->sum('totaldishes');

        $totaltrainees = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereDate('records.lunch_dates', '=', $dateis)->where('users.type', '0')->select(DB::raw('COUNT(is_taken) AS uniquerecord'))->first();

        $totalemployees = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereDate('records.lunch_dates', '=', $dateis)->where('users.type', '1')->select(DB::raw('COUNT(is_taken) AS uniquerecord'))->first();

        if ($request->ajax()) {
            if ($dateis == null) {
                $dateis = date('Y-m-d');
            }
            $record = Record::with('user')->whereDate('lunch_dates', '=', $dateis)->orderBy('lunch_dates', 'DESC')->get();

            return datatables()->of($record)
                ->editColumn('userempid', function ($userdata) {

                    return empty($userdata->user->emp_id) ? "NA" : $userdata->user->emp_id;
                })
                ->editColumn('username', function ($userdata) {
                    return empty($userdata->user->name) ? "NA" : $userdata->user->name;
                })
                ->addColumn('action', function ($userdata) {
                    $actionBtn = '<a  class="btn abc btn-danger btn-sm" data-id="' . $userdata->id . '"><i class="bi bi-trash"></i></a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.admindashboard', ['totaldishes' => $totalmonthlydishes, 'totaltrainees' => $totaltrainees->uniquerecord, 'totalemployees' => $totalemployees->uniquerecord]);
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

    public function destroy(Request $request)
    {
        $record = Record::with('user')->where('id', $request->id)->whereYear('lunch_dates', '=', date('Y'))->get();
        if (count($record) > 1) {
            $record->each->delete();
            return redirect()->back()->with('alert', 'Deleted successfully');

        } else {
            $record = Record::with('user')->where('id', $request->id)->first();
            $record->delete();
            return redirect()->back()->with('alert', 'Deleted successfully');
        }
    }
    public function useredit(Request $request)
    {
        $validated = $request->validate([
            'empNo' => 'numeric|nullable',
            'empName' => 'string',
        ]);
        if ($validated == true) {
            $userid = $request->empId;
            if ($request['empNo'] != null) {
                $update = User::where('id', '=', $userid)->update(['emp_id' => $request['empNo'], 'name' => $request['empName'], 'type' => '1']);
            } else {
                $update = User::where('id', '=', $userid)->update(['emp_id' => $request['empNo'], 'name' => $request['empName'], 'type' => '0']);
            }
            if ($update == true) {
                return redirect()->back()->with('message', 'Successfully updated details!');
            } else {
                return redirect()->back()->with('message', 'Form has not updated, Try again later!');
            }
        }
        else{
            return redirect()->back()->with('message', 'Form has not updated, Try again later!');
        }

    }
    public function destroymonthwise(Request $request)
    {
        $record = Record::with('user')->where('user_id', $request->id)->whereYear('lunch_dates', '=', date('Y'))->whereMonth('lunch_dates', '=', $request->idis)->get();
        if (count($record) > 1) {
            $record->each->delete();
            return redirect()->back()->with('alert', 'Deleted successfully');
        } else {
            $record = Record::with('user')->where('user_id', $request->id)->first();
            $record->delete();
            return redirect()->back()->with('alert', 'Deleted successfully');
        }
    }

    public function dailyDishes(Request $request)
    {
        $trainees = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.lunch_dates', '=', date('Y'))->where('users.type', '0')->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get();

        $uniquerecord = Record::select(DB::raw('DISTINCT Date(lunch_dates) as lunchdate,count(is_taken) as totaldishes'))->whereYear('lunch_dates', '=', date('Y'))->whereMonth('lunch_dates', date('m'))->groupBy('lunchdate')->get();

        $totaldishes = $uniquerecord->sum('totaldishes');

        if ($request->ajax()) {
            $uniquerecord = Record::select(DB::raw('DISTINCT Date(lunch_dates) as lunchdate,count(is_taken) as totaldishes'))->whereYear('lunch_dates', '=', date('Y'))->whereMonth('lunch_dates', date('m'))->groupBy('lunchdate')->get();
            return datatables()->of($uniquerecord, $trainees)
                ->editColumn('date', function ($userdata) {
                    return empty($userdata->lunchdate) ? "NA" : $userdata->lunchdate;
                })
                ->editColumn('total', function ($userdata) {
                    return empty($userdata->totaldishes) ? "NA" : $userdata->totaldishes;
                })
                ->addColumn('traineename', function ($userdata1) use ($trainees) {
                    return empty($trainees->name) ? "NA" : $trainees->name;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.dailydishes', ['totaldishes' => $totaldishes]);
    }

    public function trainees(Request $request)
    {

        $idis = $request->idis2;

        $trainees = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.lunch_dates', '=', date('Y'))->whereMonth('records.lunch_dates', '=', $request->idis2)->where('users.type', '0')->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get();
        if ($request->ajax()) {
            $idis = $request->idis2;
            return datatables()->of($trainees)
                ->editColumn('trainee_id', function ($userdata) {
                    return empty($userdata->emp_id) ? "NA" : $userdata->emp_id;
                })
                ->addColumn('traineename', function ($userdata) {
                    return empty($userdata->name) ? "NA" : $userdata->name;
                })
                ->addColumn('uniquerecord', function ($userdata) {
                    return empty($userdata->uniquerecord) ? "NA" : $userdata->uniquerecord;
                })
                ->addColumn('actions', function ($userdata) use ($idis) {
                    $userid = $userdata->id;
                    $query = User::where('id', '=', $userid)->get();
                    $query2 = json_decode($query, true);
                    $query1 = $query2[0]["id"];
                    $query3 = $query2[0]["emp_id"];
                    $query4 = $query2[0]["name"];
                    $query5 = $query2[0]["email"];
                    $actionBtn = '<a  class="btn traineedelete btn-danger btn-sm" data-id="' . $userdata->id . '" data-idis="' . $idis . '"><i class="bi bi-trash"></i></a>';
                    $actionBtn = $actionBtn . '<button class="btn btn-primary btn-sm ms-2 " id="edit-item"data-toggle="modal" data-userid="' . $query1 . '" data-id="' . $query3 . '" data-name="' . $query4 . '" data-email="' . $query5 . '" data-target="edit-modal" ><i class="bi bi-pencil"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return redirect('admin.dailydishes.trainees');
    }

    public function employees(Request $request)
    {

        $idis = $request->idis;

        if ($request->ajax()) {
            $idis = $request->idis;
            $uniquerecord = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.lunch_dates', '=', date('Y'))->whereMonth('records.lunch_dates', '=', $request->idis)->where('users.type', '1')->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get();
            return datatables()->of($uniquerecord)
                ->editColumn('emp_id', function ($userdata) {

                    return empty($userdata->emp_id) ? "NA" : $userdata->emp_id;
                })
                ->addColumn('employeename', function ($userdata) {
                    return empty($userdata->name) ? "NA" : $userdata->name;
                })
                ->addColumn('uniquerecord', function ($userdata) {
                    return empty($userdata->uniquerecord) ? "NA" : $userdata->uniquerecord;

                })
                ->addColumn('actions', function ($userdata) use ($idis) {
                    $userid = $userdata->id;
                    $query = User::where('id', '=', $userid)->get();
                    $query2 = json_decode($query, true);
                    $query1 = $query2[0]["id"];
                    $query3 = $query2[0]["emp_id"];
                    $query4 = $query2[0]["name"];
                    $query5 = $query2[0]["email"];
                    $actionBtn = '<a  class="btn employeedelete btn-danger btn-sm" data-id="' . $userdata->id . '" data-idis="' . $idis . '"><i class="bi bi-trash"></i></a>';
                    $actionBtn = $actionBtn . '<button class="btn btn-primary btn-sm ms-2 " id="edit-item"data-toggle="modal" data-userid="' . $query1 . '" data-id="' . $query3 . '" data-name="' . $query4 . '" data-email="' . $query5 . '" data-target="edit-modal" ><i class="bi bi-pencil"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return redirect('admin.dailydishes.employees');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('dataTable')
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('csv'),
            );
    }
}
