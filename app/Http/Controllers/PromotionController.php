<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends MainController
{

    public function getPromotions()
    {
        $promotions = Promotion::all();

        return response()->json(['promotions' => $promotions], 200);
    }
    
    public function getPromotionByid($id)
    {
        $promotion = Promotion::where('product_id', $id)->first();

        return response()->json($promotion);
    }
    public function create(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $promotion = Promotion::create([
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'discount_percentage' => $request->input('discount_percentage'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return response()->json(['promotion' => $promotion], 201);
    }
    
    public function deleteByProductId($productId)
    {
        $promotion = Promotion::where('product_id', $productId)->first();

        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found for this product'], 404);
        }

        $promotion->delete();

        return response()->json(['message' => 'Promotion deleted successfully'], 200);
    }
    
    public function managePromotion(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
    
        $productId = $request->input('product_id');
    
        // Check if the product already has a promotion
        $promotion = Promotion::where('product_id', $productId)->first();
    
        if ($promotion) {
            // Update existing promotion
            $promotion->update([
                'name' => $request->input('name'),
                'discount_percentage' => $request->input('discount_percentage'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);
        } else {
            // Create new promotion
            $promotion = Promotion::create([
                'product_id' => $productId,
                'name' => $request->input('name'),
                'discount_percentage' => $request->input('discount_percentage'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);
        }
    
        return response()->json(['promotions' => $promotion], 200);
    }
    
    // Other methods for updating, deleting, and retrieving promotions...
}
