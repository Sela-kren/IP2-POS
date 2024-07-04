<?php

namespace App\Http\Controllers;

// ============================================================================>> Core Library
use Illuminate\Http\Response; // For Responsing data back to Client

// ============================================================================>> Custom Library
// Controller
use App\Http\Controllers\MainController;

// Model
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class DashboardController extends MainController
{
    public function getDashboardInfo()
    {
        // Total sale today
        $totalSale = Order::sum('total_price');

        // Total orders
        $orderCount = Order::count();

        // Most ordered products with details
        $mostOrderedProducts = DB::table('order_details')
            ->select('product_id', DB::raw('SUM(quantity) as total_ordered'))
            ->groupBy('product_id')
            ->orderByDesc('total_ordered')
            ->limit(5) // Adjust limit as needed
            ->get();

        $lastTenOrderProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'order_details.product_id',
                'products.name as product_name',
                'order_details.unit_price',
                'order_details.quantity'
            )
            ->orderByDesc('order_details.id')
            ->limit(10)
            ->get();

        $mostOrderedCategory = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('product_types', 'products.type_id', '=', 'product_types.id')
            ->select('product_types.name as product_type_name', DB::raw('COUNT(*) as count'))
            ->groupBy('product_types.name')
            ->get();

        // Fetch details for each product
        $productsDetails = [];
        foreach ($mostOrderedProducts as $product) {
            $productDetails = Product::find($product->product_id);
            if ($productDetails) {
                $productDetails->total_ordered = $product->total_ordered;
                $productsDetails[] = $productDetails;
            }
        }

        $data = [
            'total_sale' => $totalSale,
            'total_orders' => $orderCount,
            'most_ordered_products' => $productsDetails,
            'lastTenOrderProducts' => $lastTenOrderProducts,
            'mostOrderedCategory' => $mostOrderedCategory,
        ];

        return response()->json($data, Response::HTTP_OK);
    }
}
