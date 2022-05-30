<?php

namespace App\Http\Controllers;

use App\Models\LunchDate;
use App\Models\User;
use Illuminate\Http\Request;

class LunchDateController extends Controller
{

    //update offdays
    public function addWeekend(Request $request)
    {
        LunchDate::truncate();
        $arr = explode(",", $request->dates);

        $i = 0;
        try {
            while ($i < count($arr)) {
                try {
                    LunchDate::create(['weekend' => $arr[$i]]);
                    $i++;

                } catch (\Exception $e) {
                    return redirect('offday')->with('msg', 'Something went wrong');
                }
            }
            $check = LunchDate::all();
            if ($check) {
                return redirect('/admindashboard')->with('message', 'Date Added Successfully');
            } else {
                return redirect('/admindashboard')->with('message', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect('/admindashboard')->with('message', 'Duplicate Entry');
        }
    }
 /**
     * @OA\Post(
     ** path="/api/off-days",
     *   tags={"LunchDateController"},
     *   summary="shows weekend to user",
     *   operationId="off_days",
     *
     *  @OA\RequestBody(
     *  @OA\JsonContent(
     *
     *  @OA\Property(property="user_id", type="integer"),
     *  @OA\Property(property="token", type="string"),
     *
     *
     *  )),


     *   @OA\Response(
     *      response=200,
     *       description="Successfully Taken Lunch",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     * @OA\Response(
     *          response=409,
     *          description="You already taken lunch"
     *      ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *
     *)
     **/
    //shows all off days
    public function showWeekend(Request $req)
    {
        $user = User::where('id', $req->user_id)->get();
        if ($user) {

            $offDay = LunchDate::all();
            return response($offDay, 200);

        } else {
            return response(["message" => "something went wrong"], 404);
        }
    }
}
