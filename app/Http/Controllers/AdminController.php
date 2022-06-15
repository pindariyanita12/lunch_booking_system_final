<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use App\Models\User;
use DataTables;
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

            $dateis = $request->date;
            return datatables()->of(Record::with('user')->whereDate('lunch_dates', '=', $dateis)->orderBy('lunch_dates', 'DESC')->get())
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
    public function employeeEdit(Request $request)
    {
        $validated = $request->validate([
            'empNo' => 'numeric|unique:users,emp_id',
            'empName' => ' required |regex:/^[a-zA-Z]/u',
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
        } else {
            return redirect()->back()->with('message', 'Form has not updated, Try again later!');
        }

    }

    public function destroyMonthwise(Request $request)
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
        $uniquerecord = Record::select(DB::raw('DISTINCT Date(lunch_dates) as lunchdate,count(is_taken) as totaldishes'))->whereYear('lunch_dates', '=', date('Y'))->whereMonth('lunch_dates', date('m'))->groupBy('lunchdate')->get();

        $totaldishes = $uniquerecord->sum('totaldishes');

        if ($request->ajax()) {
            return datatables()->of(Record::select(DB::raw('DISTINCT Date(lunch_dates) as lunchdate,count(is_taken) as totaldishes'))->whereYear('lunch_dates', '=', date('Y'))->whereMonth('lunch_dates', date('m'))->groupBy('lunchdate')->get())
                ->editColumn('date', function ($userdata) {
                    return empty($userdata->lunchdate) ? "NA" : $userdata->lunchdate;
                })
                ->editColumn('total', function ($userdata) {
                    return empty($userdata->totaldishes) ? "NA" : $userdata->totaldishes;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.dailydishes', ['totaldishes' => $totaldishes]);
    }

    public function trainees(Request $request)
    {
        if ($request->ajax()) {
            $idis = $request->idis2;
            return datatables()->of(DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.lunch_dates', '=', date('Y'))->whereMonth('records.lunch_dates', '=', $request->idis2)->where('users.type', '0')->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get())
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

                    $actionBtn = '<a  class="btn traineedelete btn-danger btn-sm" data-id="' . $userdata->id . '" data-idis="' . $idis . '"><i class="bi bi-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return redirect('admin.dailydishes.trainees');
    }

    public function employees(Request $request)
    {

        if ($request->ajax()) {
            $idis = $request->idis;
            return datatables()->of(DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.lunch_dates', '=', date('Y'))->whereMonth('records.lunch_dates', '=', $request->idis)->where('users.type', '1')->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get())
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

                    $actionBtn = '<a  class="btn employeedelete btn-danger btn-sm" data-id="' . $userdata->id . '" data-idis="' . $idis . '"><i class="bi bi-trash"></i></a>';
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

    public function getEmployee(Request $request)
    {

        if ($request->ajax()) {

            return datatables()->of(User::where('is_admin', '=', '0'))
                ->editColumn('userempid', function ($userdata) {
                    return empty($userdata->emp_id) ? "NA" : $userdata->emp_id;
                })
                ->editColumn('username', function ($userdata) {
                    return empty($userdata->name) ? "NA" : $userdata->name;
                })
                ->editColumn('useremail', function ($userdata) {
                    return empty($userdata->email) ? "NA" : $userdata->email;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a class="btn empdelete btn-danger btn-sm" data-id="' . $data->id . '" ><i class="bi bi-trash"></i></a>';
                    $actionBtn = $actionBtn . '&nbsp; <button class="btn btn-primary btn-sm" id="edit-emp" data-toggle="modal" data-userid="' . $data->id . '" data-empid="' . $data->emp_id . '" data-name="' . $data->name . '" data-email="' . $data->email . '" data-target="edit-modal" ><i class="bi bi-pencil"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.employee');
    }

    public function empDelete(Request $request)
    {
        $delete = DB::table('users')->where('id', $request->id)->delete();
        return redirect()->back()->with('alert', 'Deleted successfully');
    }

    public function addEmployee(Request $request)
    {
        $empNo = $request->emp_no;

        if ($empNo != null) {

            $validate = $request->validate([
                "emp_no" => "numeric | unique:users,emp_id",
                'emp_name' => 'required |regex:/^[a-zA-Z]/u',
                'emp_email' => 'required | email | unique:users,email',
            ]);
            $userExist = User::where('emp_id', $empNo)->where('email', '=', $request->emp_email)->first();
            if ($userExist) {
                return redirect()->back()->with('alert', 'Already Present');
            } else {
                User::insert([
                    "emp_id" => $request->emp_no,
                    "name" => $request->emp_name,
                    "email" => $request->emp_email,
                    "type" => "1",
                ]);
            }
        } else {
            $traineeExist = User::where('email', '=', $request->emp_email)->first();
            if ($traineeExist) {
                return redirect()->back()->with('alert', 'Already Present');
            } else {
                User::insert([
                    "name" => $request->emp_name,
                    "email" => $request->emp_email,
                    "type" => "0",
                ]);
            }
        }
        return redirect()->back()->with('alert', 'Added successfully');

    }
    public function addGuests(Request $request)
    {
        $validate = $request->validate([
            "empNo" => "numeric",
        ]);

        $count = $request->totalguests;
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d H:i:s');

        $finduserid = User::where('emp_id', env('EMP_ID'))->first();

        for ($i = 0; $i < $count; $i++) {
            Record::insert([
                "user_id" => $finduserid->id,
                "is_taken" => 1,
                "lunch_dates" => $date,
            ]);
        }
        return redirect()->back()->with('alert', 'Added successfully');
    }

    public function addManualRecord(Request $request)
    {
        $validate = $request->validate([
            "empNo" => "string",
        ]);
        $empNo = strtok($request->empNo, ' ');
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));

        $findemp = User::where('emp_id', $empNo)->first();
        if ($findemp == null) {
            return redirect()->back()->with('alert', 'No simformer registered on this Id');
        }
        $userid = $findemp->id;
        $checkrecord = Record::where('user_id', $userid)->whereDate('lunch_dates', $date)->first();

        if ($checkrecord) {
            return redirect()->back()->with('alert', 'Already taken');

        } else {

            $userid = $findemp->id;

            Record::insert([
                "user_id" => $userid,
                "is_taken" => 1,
                "lunch_dates" => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with('alert', 'Added successfully');
        }

    }
    public function autoComplete(Request $request)
    {
        $res = User::select("emp_id", "name")
            ->where("emp_id", "LIKE", "{$request->search}%")
            ->get();

        $response = array();
        foreach ($res as $employee) {
            $response[] = array("value" => $employee->emp_id . ' -' . $employee->name, "label" => $employee->emp_id . ' -' . $employee->name);
        }

        return response()->json($response);
    }
}
