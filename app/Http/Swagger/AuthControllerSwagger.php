<?php
/**
     * @OA\Post(
     ** path="/signin",
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
     **/
