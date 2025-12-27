<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderInfoController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();

    return view('frontend.order.index', compact('cartItems'));
    }
}
