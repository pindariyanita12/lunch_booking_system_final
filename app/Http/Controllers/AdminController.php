<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Facades\Config;
use Session;
class AdminController extends Controller
{
    
    public function lang($lang){
        // dd($lang);
        // $lang = Config::get('app.languages');
        // dd($lang);
       if(array_key_exists($lang,Config::get('app.languages'))){
           Session::put('locale',$lang);
       }
       return redirect()->back();
    }

    //admin dashboard
    public function show(Request $request)
    {
        // // global $lang;
        // print_r($this->lang);
        // App::setLocale($this->lang);
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
                    $actionBtn = '<a href="' . route('admin.admindashboard.destroy', [$userdata->user->id, $userdata->id]) . '" class="btn btn-danger btn-sm" ><i class="bi bi-trash"></i></a>';
                    $actionBtn = $actionBtn .'<button id="edit-item" type="button" name="edit-item" data-target-id="'.$userdata->id.'" class="edit btn btn-primary btn-sm ms-2" data-toggle="modal" data-target="edit-modal"><i class="bi bi-pencil"></i></button>';
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
        // App::setLocale($this->lang);
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
        // App::setLocale($this->lang);
        if ($request->ajax()) {
            $idis = $request->date;
            $record = Record::with('user')->whereDate('created_at', '=', $request->date)->get();
            return datatables()->of($record)
                ->editColumn('userempid', function ($userdata) {
                    return empty($userdata->user->emp_id) ? "NA" : $userdata->user->emp_id;
                })
                ->editColumn('username', function ($userdata) {
                    return empty($userdata->user->name) ? "NA" : $userdata->user->name;
                })
                ->addColumn('action', function ($userdata) use ($idis) {
                    $actionBtn = '<a href="' . route('admin.admindashboard.destroy', [$userdata->user->id, $idis]) . '" class="btn btn-danger btn-sm" ><i class="fa fa-trash ">Delete</i></a>';  
                })
                ->make(true);
        }
        return view('admin.dateWiserecord');

    }

    //monthwise records
    public function monthWise(Request $request)
    {
        // App::setLocale($this->lang);
        if ($request->ajax()) {

            $idis = $request->idis;
            $uniquerecord = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.created_at', '=', date('Y'))->whereMonth('records.created_at', '=', $request->idis)->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get();

            return datatables()->of($uniquerecord, $idis)

                ->editColumn('userempid', function ($userdata) {

                    return empty($userdata->user->emp_id) ? "NA" : $userdata->user->emp_id;
                })
                ->editColumn('username', function ($userdata) {
                    return empty($userdata->user->name) ? "NA" : $userdata->user->name;
                })
                ->editColumn('uniquerecord', function ($userdata) {
                    return $userdata->uniquerecord;
                })
                ->addColumn('action', function ($userdata) use ($idis) {
                    $actionBtn = '<a href="' . route('admin.admindashboard.destroy', [$userdata->id, $idis]) . '" class="btn btn-danger btn-sm" ><i class="fa fa-trash ">Delete</i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.monthWiserecord');
    }

    public function destroy(Request $request)
    {
        $record = Record::with('user')->where('user_id', $request->id)->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', $request->idis)->get();
        if (count($record) > 1) {
            $record->each->delete();
            return redirect('/admindashboard');

        } else {
            $record = Record::with('user')->where('user_id', $request->id)->first();
            $record->delete();
            return redirect('/admindashboard');

        }

    }

    public function useredit(Request $request){
        dd($request->id);
    }
    
    public function dailyDishes(Request $request)
    {
        //  App::setLocale($this->lang);

        $uniquerecord = Record::select(DB::raw('DISTINCT Date(created_at) as lunchdate,count(is_taken) as totaldishes'))->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', date('m'))->groupBy('lunchdate')->get();
        $totaldishes = $uniquerecord->sum('totaldishes');
        if ($request->ajax()) {
            $uniquerecord = Record::select(DB::raw('DISTINCT Date(created_at) as lunchdate,count(is_taken) as totaldishes'))->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', date('m'))->groupBy('lunchdate')->get();
            return datatables()->of($uniquerecord)
                ->editColumn('date', function ($userdata) {
                    return empty($userdata->lunchdate) ? "NA" : $userdata->lunchdate;
                })
                ->editColumn('total', function ($userdata) {
                    return empty($userdata->totaldishes) ? "NA" : $userdata->totaldishes;
                })

                ->make(true);
        }
        return view('admin.dailydishes', ['totaldishes' => $totaldishes]);
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
