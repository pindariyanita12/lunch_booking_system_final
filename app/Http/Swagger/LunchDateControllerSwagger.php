<?php
/**
     * @OA\Post(
     ** path="/off-days",
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
