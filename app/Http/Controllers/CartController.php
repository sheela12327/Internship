<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request) {
        $product = Product::find($request->product_id);
        if(!$product) return redirect()->back()->with('error','Product not found');

        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])){
            $cart[$product->id]['qty'] += $request->quantity ?? 1;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'qty' => $request->quantity ?? 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success','Product added to cart');
    }

    public function updateQuantity(Request $request) {
        $cart = session()->get('cart', []);
        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['qty'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return response()->json(['success'=>true]);
    }

    public function remove(Request $request) {
        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);
        return response()->json(['success'=>true]);
    }
}
