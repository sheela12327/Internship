<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
        public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products.index', compact('products','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price ?? 0;
        $product->stock = $request->stock ?? 0;

        // Set flags
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->is_hot_deal = $request->has('is_hot_deal') ? 1 : 0;
        $product->is_top_selling = $request->has('is_top_selling') ? 1 : 0;

        // Set active so it shows on homepage
        $product->is_active = 1;

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        // Return JSON if AJAX
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'category_name' => $product->category->name,
            'category_id' => $product->category_id,
            'price' => $product->price,
            'stock' => $product->stock,
            'description' => $product->description,
            'is_featured' => $product->is_featured,
            'is_hot_deal' => $product->is_hot_deal,
            'is_top_selling' => $product->is_top_selling,
            'image' => $product->image,
        ]);
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'old_price'   => 'nullable|numeric',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['status'] = $request->has('status');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_hot_deal'] = $request->has('is_hot_deal');
        $validated['is_top_selling'] = $request->has('is_top_selling');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success','Product updated');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'success' => true
        ]);
    }
}