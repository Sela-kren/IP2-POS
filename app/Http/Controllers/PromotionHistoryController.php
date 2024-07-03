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
}
