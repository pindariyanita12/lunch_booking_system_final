<?php
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
     **/

    /**
 * @OA\Post(
 *      path="/signin",
 *      operationId="deleteChild",
 *      tags={"ChildController"},
 *      description="delete child",
 *      summary="deleteChild",
 *      @OA\Parameter(
 *          name="child_id",
 *          description="Child id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *      )),
 *      @OA\Parameter(
 *          name="parent_id",
 *          description="parent id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *      )),
 *      @OA\Response(
 *        response= 200,
 *        description= "Success",
 *        @OA\MediaType(
 *        mediaType="application/json",
 *        example={
 *             "status" : "Success",
 *             "message": "Deleted successfully.",
 *         }
 *        )
 *      ),
 *      @OA\Response(
 *             response=401,
 *             description="Unauthorized"
 *      ),
 *      @OA\Response(
 *             response=403,
 *             description="Forbidden"
 *      ),
 *      @OA\Response(
 *             response=404,
 *             description="Not Found"
 *      ),
 *      @OA\Response(
 *             response=500,
 *             description="Internal Server Error"
 *      ),
 *      security={
 *          { "apiAuth": {} }
 *      }
 * )
 *
 * Returns list of all users
 */


