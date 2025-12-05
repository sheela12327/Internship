<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Customer dashboard
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    // Customer orders
    public function orders()
    {
        return view('customer.orders');
    }

    // public function index()
    // {
    //     if (Auth::check() && Auth::user()->user_type == "customer") {
    //         return redirect()->route('dashboard');
    //     } elseif (Auth::check() && Auth::user()->user_type == "admin") {
    //         return redirect()->route('admin.dashboard');
    //     }
    //     return redirect()->route('login');
    // }
}
