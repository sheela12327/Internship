<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index() {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request) {
        $product = Product::findOrFail($request->product_id);
        $cart = Session::get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += 1;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'qty' => 1
            ];
        }

        Session::put('cart', $cart);
        return response()->json(['success'=>true, 'cart_count'=>count($cart)]);
    }

    public function remove(Request $request) {
        $cart = Session::get('cart', []);
        if(isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            Session::put('cart', $cart);
        }
        return response()->json(['success'=>true, 'cart_count'=>count($cart)]);
    }

    public function count() {
        $cart = Session::get('cart', []);
        $totalItems = array_sum(array_column($cart, 'qty'));
        return response()->json(['count'=>$totalItems]);
    }
}
