<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display all products (Shop Page)
     */
    public function index(Request $request)
    {
        $query = Product::where('status', 1);

        // Search by product name or category name
        if ($request->has('search')) {
            $search = $request->search;

            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }

        // Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(9);
        $categories = Category::where('status', 1)->get();

        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Show single product details
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
                          ->where('status', 1)
                          ->firstOrFail();

        return view('shop.show', compact('product'));
    }
}
