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
            'discount' => 'nullable|numeric',
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
}
