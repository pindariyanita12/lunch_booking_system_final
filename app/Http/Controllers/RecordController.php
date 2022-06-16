<?php
namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //checks whether lunch taken or not
    public function lunchTaken(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $record = Record::create(['user_id' => auth()->user()->id, 'is_taken' => 1,'lunch_dates'=> date('Y-m-d H:i:s')]);
        \Session::flash('alert', 'Enjoy your lunch');
        return redirect()->back();
    }
}
