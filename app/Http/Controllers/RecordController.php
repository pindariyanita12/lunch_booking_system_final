<?php
namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * @OA\Post(
     ** path="/lunch-taken",
     *   tags={"RecordController"},
     *   summary="lunch taken or not",
     *   operationId="lunch_taken",
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
    //checks whether lunch taken or not
    public function lunchTaken(Request $request)
    {
        $date = date("Y-m-d");
        $date = date('Y-m-d', strtotime($date));
        $check = Record::where('user_id', $request->user_id)->where('is_taken', 1)->whereDate('created_at', '=', $date)->orderby('created_At', 'DESC')->first();

        if ($check) {
            return response(['message' => 'You already taken lunch'], 409);
        } else {
            $record = Record::create(['user_id' => $request->user_id]);
            $record->is_taken = 1;
            $record->save();

            return response(['message' => 'Successfully Taken Lunch'], 200);
        }
    }
}
