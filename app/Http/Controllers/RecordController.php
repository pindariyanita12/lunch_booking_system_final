<?php
namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //add lunch request
    public function addRequest(Request $request)
    {

        $check = Record::where('email', $request->mail)->where('is_taken', 0)->orderby('created_At','DESC')->first();

        if ($check) {
            return response(['message' => 'You already registered for lunch'], 409);
        } else {

            $record = Record::create(['email' => $request->mail]);

            if ($record) {
                return response(['message' => 'Successfully Add'], 201);
            } else {
                return response(['message' => 'Something went wrong'], 404);
            }
        }
    }

    //add request with guests
    public function addGuests(Request $request)
    {
        $check = Record::where('email', $request->mail)->where('is_taken', 0)->get();
        if ($check->count()) {
            return response(['message' => 'You already registered for lunch'], 409);
        } else {
            $record = Record::create(['email' => $request->mail, 'guests' => $request->guests]);
            if ($record) {
                return response(['message' => 'Successfully Add'], 201);
            } else {
                return response(['message' => 'Something went wrong'], 404);
            }
        }
    }

    //delete request
    public function deleteRequest(Request $request)
    {
        $check = Record::where('email', $request->mail)->where('is_taken', 0)->orderBy('created_at', 'DESC')->first();
        if ($check) {
            $check = $check->delete();
            if (!$check) {
                return response(['message' => 'Request is not Deleted'], 503);
            } else {
                return response(['message' => 'Request Deleted Successfully'], 200);
            }
        } else {
            return response(['message' => 'You are not registered for lunch'], 404);
        }
    }

    //checks whether lunch taken or not
    public function lunchTaken(Request $request)
    {
        $check = Record::where('email', $request->mail)->where('is_taken', 0)->orderBy('created_at', 'DESC')->first();
        if ($check) {
            $check->is_taken = 1;
            $check->save();
            if (!$check) {
                return response(['message' => 'Not able To Take Lunch'], 503);
            } else {
                return response(['message' => 'Successfully Taken Lunch'], 200);
            }
        } else {
            return response(['message' => 'You Already Taken Lunch'], 404);
        }
    }

}
