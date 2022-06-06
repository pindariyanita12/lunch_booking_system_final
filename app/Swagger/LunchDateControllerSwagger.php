<?php
namespace App\Swagger;

/**
 * @OA\Post(
 ** path="/off-day",
 *   tags={"LunchDateController"},
 *   summary="shows offdays to user",
 *   operationId="off-day",
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
 *       description="Offdays",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
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

class LunchDateControllerSwagger
{

}
