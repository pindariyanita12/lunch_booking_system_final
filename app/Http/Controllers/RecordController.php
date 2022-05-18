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
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));
        $check = Record::where('email', $request->mail)->where('is_taken', 1)->whereDate('created_at', '=', $date)->orderby('created_At', 'DESC')->first();

        if($check){
            return response(['message' => 'You already taken lunch'], 409);
        }
        else{
        $record = Record::create(['email' => $request->mail]);
        $record->is_taken=1;
        $record->save();

        return response(['message' => 'Successfully Taken Lunch'], 200);
        }
    }

    //add lunch request
    // public function addRequest(Request $request)
    // {

    //     $check = Record::where('email', $request->mail)->where('is_taken', 0)->orderby('created_At', 'DESC')->first();
    //     $date = date("Y-m-d");
    //     $date = date('Y-m-d', strtotime($date));

    //     $avdate = date('Y-m-d', strtotime('+1 Day'));

    //     $available_date = $avdate;
    //     $lunchdates = LunchDate::select('weekend')->pluck('weekend');

    //     $i = 0;

    //     while ($i < sizeof($lunchdates)) {

    //         if ($lunchdates[$i] == $available_date) {

    //             $available_date = date('Y-m-d', strtotime($lunchdates[$i] . ' +1 day'));

    //         }
    //         $i++;

    //     }
    //     if ($check) {
    //         return response(['message' => 'You already taken lunch'], 409);
    //     } else {

    //         $record = Record::create(['email' => $request->mail, 'requestdate' => $available_date]);

    //         if ($record) {
    //             return response(['message' => 'Successfully taken lunch'], 201);
    //         } else {
    //             return response(['message' => 'Something went wrong'], 404);
    //         }
    //     }
    // }

    //add request with guests
    // public function addGuests(Request $request)
    // {
    //     $check = Record::where('email', $request->mail)->where('is_taken', 0)->get();
    //     $date = date("Y-m-d");
    //     $date = date('Y-m-d', strtotime($date));

    //     $avdate = date('Y-m-d', strtotime('+1 Day'));

    //     $available_date = $avdate;
    //     $lunchdates = LunchDate::select('weekend')->pluck('weekend');

    //     $i = 0;

    //     while ($i < sizeof($lunchdates)) {

    //         if ($lunchdates[$i] == $available_date) {

    //             $available_date = date('Y-m-d', strtotime($lunchdates[$i] . ' +1 day'));

    //         }
    //         $i++;

    //     }
    //     if ($check->count()) {
    //         return response(['message' => 'You already registered for lunch'], 409);
    //     } else {
    //         $record = Record::create(['email' => $request->mail, 'guests' => $request->guests,'requestdate'=>$available_date]);
    //         if ($record) {
    //             return response(['message' => 'Successfully Add'], 201);
    //         } else {
    //             return response(['message' => 'Something went wrong'], 404);
    //         }
    //     }
    // }

    //delete request
    // public function deleteRequest(Request $request)
    // {
    //     $check = Record::where('email', $request->mail)->where('is_taken', 0)->orderBy('created_at', 'DESC')->first();
    //     if ($check) {
    //         $check = $check->delete();
    //         if (!$check) {
    //             return response(['message' => 'Request is not Deleted'], 503);
    //         } else {
    //             return response(['message' => 'Request Deleted Successfully'], 200);
    //         }
    //     } else {
    //         return response(['message' => 'You are not registered for lunch'], 404);
    //     }
    // }

}
