<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // Display all products with search, sorting, and pagination
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search')) {
            $query->where('product_id', 'like', "%{$request->search}%")
                  ->orWhere('name', 'like', "%{$request->search}%")
                  ->orWhere('price', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
        }

        // Sorting functionality
        if ($request->has('sort_by') && in_array($request->sort_by, ['name', 'price'])) {
            $query->orderBy($request->sort_by, $request->sort_direction === 'desc' ? 'desc' : 'asc');
        }

        // Paginate the results
        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

    // Show the form to create a new product
    public function create()
    {
        return view('products.create');
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => '|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string', // Validate description
            'image' => 'required|image|max:2048',
        ]);

        // Store image
        $path = $request->file('image')->store('images', 'public');
        $validated['image'] = $path;

        // Create the product
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }



    
    // Show the form to edit an existing product
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update the product in the database
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string', // Validate description
            'image' => 'nullable|image',
        ]);
    
        // If a new image is uploaded, delete the old image
        if ($request->hasFile('image')) {
            if ($product->image && \Storage::exists('public/' . $product->image)) {
                \Storage::delete('public/' . $product->image);
            }
    
            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }
    
        // Update the product with new data
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete the product from the database
    public function destroy(Product $product)
    {
       // Delete the image from storage
    if ($product->image && \Storage::exists('public/' . $product->image)) {
        \Storage::delete('public/' . $product->image);
    }

    // Delete the product record from the database
    $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function show(Product $product)
{
    return view('products.show', compact('product'));
}

}
