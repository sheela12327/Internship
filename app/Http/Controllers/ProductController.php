<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Product list
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    // Show product create form (not needed for modal)
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store product
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return back()->with('success', 'Product added successfully!');
    }

    // Fetch for edit modal
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Update product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return back()->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}
