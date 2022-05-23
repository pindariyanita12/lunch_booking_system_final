<?php
namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{

    //checks whether lunch taken or not
    public function lunchTaken(Request $request)
    {
        // dd($request->all());
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));
        $check = Record::where('user_id', $request->user_id)->where('is_taken', 1)->whereDate('created_at', '=', $date)->orderby('created_At', 'DESC')->first();

        if($check){
            return response(['message' => 'You already taken lunch'], 409);
        }
        else{
        $record = Record::create(['user_id' => $request->user_id]);
        $record->is_taken=1;
        $record->save();

        return response(['message' => 'Successfully Taken Lunch'], 200);
        }
    }

}
