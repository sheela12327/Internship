<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return Product::active()
            ->where('status', 1)
            ->with('category')
            ->latest()
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (!$product->is_active || !$product->status) {
            return response()->json(['message' => 'Product unavailable'], 404);
        }

        return $product->load('category');
    }

    /**
     * GET /api/products/{product}/stock
     * Check product stock
     */
    public function stock(Product $product)
    {
        return response()->json([
            'product_id' => $product->id,
            'stock' => $product->stock,
            'in_stock' => $product->isInStock()
        ]);
    }

    /**
     * GET /api/products/featured
     */
    public function featured()
    {
        return Product::active()
            ->featured()
            ->where('status', 1)
            ->get();
    }

    /**
     * GET /api/products/top-selling
     */
    public function topSelling()
    {
        return Product::active()
            ->topSelling()
            ->where('status', 1)
            ->get();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
