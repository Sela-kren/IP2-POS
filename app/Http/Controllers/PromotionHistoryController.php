<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromotionHistory;

class PromotionHistoryController extends MainController
{
    public function index()
    {
        $promotionHistory = PromotionHistory::all();

        return response()->json(['promotion_history' => $promotionHistory], 200);
    }
}
