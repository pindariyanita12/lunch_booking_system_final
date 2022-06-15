<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function home(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $recordDate = new DateTime();
        $recordDate->modify('-10 minutes');
        $formatted_date = $recordDate->format('Y-m-d H:i:s');
        $record = Record::where('lunch_dates', '>=', $formatted_date)->count();
        $isLunchTaken = Record::where('user_id', auth()->user()->id)->where('is_taken', 1)->whereDate('lunch_dates', '=', date('Y-m-d'))->exists();
        $lunchAvailabiltyTomorrow = LunchDate::where('weekend', Carbon::tomorrow())->exists();
        $lunchAvailabiltyToday = LunchDate::where('weekend', Carbon::now()->format('Y-m-d'))->exists();
        return view('user.welcome', compact('isLunchTaken', 'lunchAvailabiltyTomorrow', 'lunchAvailabiltyToday', 'record'));
    }
}
