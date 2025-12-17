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
        if(!$product) return response()->json(['success'=>false, 'message'=>'Product not found']);

        $cart = session()->get('cart', []);
        $qty = $request->quantity ?? 1;

        if(isset($cart[$product->id])){
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'qty' => $qty
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => count($cart)
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $cart = Session::get('cart', []);

        $productId = $request->product_id;
        $quantity  = $request->quantity;

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = $quantity;
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }
    
    public function remove(Request $request) {
        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);
        return response()->json(['success'=>true]);
    }
}
