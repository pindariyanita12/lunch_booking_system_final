<?php
namespace App\Swagger;

/**
 * @OA\Post(
 * path="/signin",
 *   tags={"AuthController"},
 *   summary="sign in",
 *   operationId="signin",
 *
 *   @OA\Response(
 *      response=200,
 *       description="Link generated",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
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

 * @OA\Post(
 ** path="/signout",
 *   tags={"AuthController"},
 *   summary="signouts user",
 *   operationId="signout",
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
 *       description="Logged out",
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



 * @OA\Post(
 ** path="/getdata",
 *   tags={"AuthController"},
 *   summary="user info",
 *   operationId="user info",
 *
 *  @OA\RequestBody(
 *  @OA\JsonContent(
 *
 *  @OA\Property(property="code", type="string"),
 *
 *
 *  )),


 *   @OA\Response(
 *      response=200,
 *       description="Success",
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

class AuthControllerSwagger
{

}
