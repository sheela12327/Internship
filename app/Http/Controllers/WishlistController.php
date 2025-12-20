<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Session::get('wishlist', []);
        return view('wishlist.index', compact('wishlist'));
    }

    public function add(Request $request)
    {
        // ✅ Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $wishlist = Session::get('wishlist', []);

        if (isset($wishlist[$product->id])) {
            return response()->json([
                'success' => false,
                'message' => 'Already in wishlist',
                'wishlist_count' => count($wishlist)
            ]);
        }

        $wishlist[$product->id] = [
            'id'    => $product->id,
            'name'  => $product->name,
            'image' => $product->image,
            'price' => $product->price
        ];

        Session::put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'message' => 'Added to wishlist',
            'wishlist_count' => count($wishlist)
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $wishlist = Session::get('wishlist', []);

        if (isset($wishlist[$request->product_id])) {
            unset($wishlist[$request->product_id]);
            Session::put('wishlist', $wishlist);
        }

        return response()->json([
            'success' => true,
            'message' => 'Removed from wishlist',
            'wishlist_count' => count($wishlist)
        ]);
    }

    public function count()
    {
        $wishlist = Session::get('wishlist', []);
        return response()->json([
            'count' => count($wishlist)
        ]);
    }
}
