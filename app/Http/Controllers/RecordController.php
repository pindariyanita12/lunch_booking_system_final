<?php
namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //checks whether lunch taken or not
    public function lunchTaken(Request $request)
    {
        $isLunchTaken = Record::where('user_id', auth()->user()->id)->where('is_taken', 1)->whereDate('lunch_dates', '=', date('Y-m-d'))->exists();
        if ($isLunchTaken) {
            \Session::flash('alert', 'You already taken lunch');
            return redirect()->back();
        } else {
            $record = Record::create(['user_id' => auth()->user()->id, 'is_taken'=> 1]);
            \Session::flash('alert', 'Enjoy your lunch');
            return redirect()->back();
        }
    }
}
