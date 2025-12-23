<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /* =========================
       ADMIN METHODS
    ==========================*/

    public function index()
    {
        $products = Product::with('category')->latest()->get();
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
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric',
            'old_price'   => 'nullable|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['is_active']      = 1;
        $validated['is_featured']    = $request->has('is_featured');
        $validated['is_hot_deal']    = $request->has('is_hot_deal');
        $validated['is_top_selling'] = $request->has('is_top_selling');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products','public');
        }

        $product = Product::create($validated);
        

        // AJAX support
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'product' => $product->load('category')
            ]);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success','Product created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'old_price'   => 'nullable|numeric',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['is_active']      = $request->has('is_active');
        $validated['is_featured']    = $request->has('is_featured');
        $validated['is_hot_deal']    = $request->has('is_hot_deal');
        $validated['is_top_selling'] = $request->has('is_top_selling');

        if ($request->hasFile('image')) {

            // delete old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products','public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(['success' => true]);
    }

    /* =========================
       FRONTEND METHODS
    ==========================*/

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function featured()
    {
        return Product::where('is_active',1)
            ->where('is_featured',1)
            ->latest()
            ->get();
    }

    public function topSelling()
    {
        return Product::where('is_active',1)
            ->where('is_top_selling',1)
            ->latest()
            ->get();
    }
}