<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromotionHistory;
use Illuminate\Support\Facades\DB;

class PromotionHistoryController extends MainController
{
    public function index()
    {
        $promotionHistory = DB::table('promotion_history')
            ->select('promotion_history.*', 'products.name as product_name')
            ->leftJoin('products', 'promotion_history.product_id', '=', 'products.id')
            ->get();

        return response()->json(['promotion_history' => $promotionHistory], 200);
    }


    public function getPromotionHistoryByProductId($productId)
    {
        $promotionHistory = DB::table('promotion_history')
            ->select('promotion_history.*', 'products.name as product_name')
            ->leftJoin('products', 'promotion_history.product_id', '=', 'products.id')
            ->where('promotion_history.product_id', $productId)
            ->orderBy('promotion_history.created_at', 'desc') // Change 'created_at' to the appropriate timestamp column
            ->get();

        if ($promotionHistory->isEmpty()) {
            return response()->json(['message' => 'No promotion history found for this product'], 404);
        }

        return response()->json($promotionHistory, 200);
    }
}
