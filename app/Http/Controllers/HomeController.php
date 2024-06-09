<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * @OA\Post(
 *     path="api/products/create",
 *     summary="add the products",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 *
 * @OA\get(
 *     path="/api/products",
 *     summary="Get list of users",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 * 
 * @OA\Post(
 *     path="/api/products/{id}/addstock",
 *     summary="add stock to the exsiting product by product id",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 * 
 * @OA\Post(
 *     path="/api/products/search",
 *     summary="add stock to the exsiting product by product id",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 * 
 *  @OA\Get(
 *     path="/api/products/products_types",
 *     summary="add stock to the exsiting product by product id",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 * 
 * @OA\Post(
 *     path="/api/promotion/manage",
 *     summary="manage the promotion for product by productID",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 * 
 * @OA\Post(
 *     path="/api/promotion/{productId}",
 *     summary="delete the promotion from promotion by productID",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 * 
 *  @OA\get(
 *     path="/api/promotion",
 *     summary="list all the promotion",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 * 
 *  @OA\get(
 *     path="/api/promotionHistory",
 *     summary="check the history of promotion history",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
class HomeController extends Controller
{
    //
}
