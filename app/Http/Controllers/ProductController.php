<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // return response()->json($products);
        return view('product')->with('products', $products);
    }

    public function store(Request $request)
    {
            // Validate incoming request
        $validatedData = $request->validate([
            'type_id' => 'required|integer',
            'code' => 'required|string',
            'name' => 'required|string',
            'image' => 'nullable|string',
            'unit_price' => 'required|numeric',
            'stock' => 'required|numeric',
            // 'discount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath; // Update the 'image' field in validated data
        }

        // Create new product
        $product = new Product();
        $product->fill($validatedData); // Mass assignment of validated data to product attributes

        // Save the product
        $product->save();

        // Return a response with the created product and HTTP status 201 (Created)
        return response()->json($product, 201);
     
    }
    
    public function addStock(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1', // Validate the incoming request data
        ]);

        $product = Product::findOrFail($productId); // Find the product by ID
        $quantityToAdd = $request->input('quantity');

        $product->stock += $quantityToAdd; // Increment the stock
        $product->save(); // Save the updated product

        return response()->json(['message' => 'Stock added successfully', 'product' => $product], 200);
    }
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:1', // Validate the incoming query parameter
        ]);

        $query = $request->input('query');

        $products = Product::where('name', 'like', "%$query%") // Search by product name
                           ->orWhere('code', 'like', "%$query%") // Search by product code
                           ->orWhere('description', 'like', "%$query%") // Search by product description
                           ->get();

        return response()->json(['products' => $products], 200);
    }
    
}
