<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        $productTypes = ProductType::all();
        return response()->json($productTypes);
    }
    public function create()
    {
        return view('create');
    }
    // working funtion with string

    public function show($id)
    {
        // Find the product type by ID
        $productType = ProductType::find($id);
    
        if (!$productType) {
            // Return a 404 response if the product type is not found
            return response()->json(['error' => 'Product type not found'], 404);
        }
    
        // Return a JSON response with the product type data
        return response()->json($productType);
    }
    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'icon' => 'required|string|max:255',
    //     ]);

    //     // Create a new product type instance
    //     $productType = ProductType::create([
    //         'name' => $request->name,
    //         'icon' => $request->icon,
    //     ]);

    //     // Return a JSON response with the newly created product type and a status code of 201 (Created)
    //     return response()->json($productType, 201);
    // }

    
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData2 = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            
        ]);

        if ($request->hasFile('icon')) { // Check if an image file is uploaded
            $imagePath = $request->file('icon')->store('product_type_images', 'public');
            $validatedData2['icon'] = $imagePath;
        }
        // Create a new product type instance
        $productTypes = new ProductType();
        $productTypes->fill($validatedData2);
        $productTypes->save();


        // Return a JSON response with the newly created product type and a status code of 201 (Created)
        return response()->json($productTypes, 201);
    }
}
