<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index() {
        $wishlist = Session::get('wishlist', []);
        return view('wishlist.index', compact('wishlist'));
    }

    public function add(Request $request) {
        $product = Product::findOrFail($request->product_id);
        $wishlist = Session::get('wishlist', []);

        if(!isset($wishlist[$product->id])) {
            $wishlist[$product->id] = [
                'name' => $product->name,
                'image' => $product->image
            ];
        }

        Session::put('wishlist', $wishlist);
        return response()->json(['success'=>true, 'wishlist_count'=>count($wishlist)]);
    }

    public function remove(Request $request) {
        $wishlist = Session::get('wishlist', []);
        if(isset($wishlist[$request->product_id])) {
            unset($wishlist[$request->product_id]);
            Session::put('wishlist', $wishlist);
        }
        return response()->json(['success'=>true, 'wishlist_count'=>count($wishlist)]);
    }

    public function count() {
        $wishlist = Session::get('wishlist', []);
        return response()->json(['count'=>count($wishlist)]);
    }
}
