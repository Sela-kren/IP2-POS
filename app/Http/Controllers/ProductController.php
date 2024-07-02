<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends MainController
{   

    public function delete($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete associated promotion if exists
        // $product->promotion()->delete();

        // Delete the product
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }


    public function index()
    {
        $products = Product::all();
        return response()->json($products);
        // return view('product')->with('products', $products);
    }
    public function show()
    {
          // Eager load the productType and promotion relationships
        $products = Product::with(['productType', 'promotion'])->get();

        return response()->json($products); 
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
    

    public function updateP(Request $request, $id)
    {   
        $validatedData = $request->validate([
            'code' => 'required|string',
            'type_id' => 'required|numeric',
            'name' => 'required|string',
            'unit_price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'promotion_name' => 'required|string',
            'discount_percentage' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
        ]);
        // Validate incoming data
       
        // return response()->json(['message' => 'Product and promotion updated successfully']);
        // Find the product to update
        $product = Product::findOrFail($id);
    
        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // Delete the previous image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            // Store the new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath; // Update the 'image' field in the product model
        }
        
        // Update product attributes
        $product->code = $validatedData['code'];
        $product->type_id = $validatedData['type_id'];
        $product->name = $validatedData['name'];
        $product->unit_price = $validatedData['unit_price'];
        $product->stock = $validatedData['stock'];
        $product->description = $validatedData['description'];
        $product->save();
        
        // Update or create promotion
        $promotion = Promotion::where('product_id', $id)->firstOrNew([]);
        $promotion->product_id = $product->id;
        $promotion->name = $validatedData['promotion_name'];
        $promotion->discount_percentage = $validatedData['discount_percentage'];
        $promotion->start_date = $validatedData['start_date'];
        $promotion->end_date = $validatedData['end_date'];
        $promotion->save();
    
        return response()->json(['message' => 'Product and promotion updated successfully', 'product' => $product, 'promotion' => $promotion]);
        
    }
    
    public function create(Request $request)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'code' => 'required|string',
        'type_id' => 'required|numeric',
        'name' => 'required|string',
        'unit_price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'promotion_name' => 'nullable|string',
        'discount_percentage' => 'nullable|integer|min:0|max:100',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after:start_date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
    ]);

    // Handle file upload if an image is provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product_images', 'public');
        $validatedData['image'] = $imagePath; // Update the 'image' field in validated data
    }

    // Create new product
    $product = new Product();
    $product->fill($validatedData); // Mass assignment of validated data to product attributes
    $product->save(); // Save the product

    // Create promotion if provided
    if (isset($validatedData['promotion_name'])) {
        $promotion = new Promotion();
        $promotion->product_id = $product->id;
        $promotion->name = $validatedData['promotion_name'];
        $promotion->discount_percentage = $validatedData['discount_percentage'];
        $promotion->start_date = $validatedData['start_date'];
        $promotion->end_date = $validatedData['end_date'];
        $promotion->save();
    }

    // Return a response with the created product and HTTP status 201 (Created)
    return response()->json([
        'message' => 'Product and promotion created successfully',
        'product' => $product,
        'promotion' => $promotion ?? null
    ], 201);
}



    public function getProductById($id)
    {
        $product = Product::with(['productType', 'promotion'])->findOrFail($id);
        return response()->json($product);
    }
}
