<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // only authenticated users
    }

    // Customer dashboard / home page
    public function index1()
    {
        $user = Auth::user();

        // Redirect admin to admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Normal customer view
        return view('home'); 
    }

    public function index()
    {
        $categories = Category::where('status',1)->get();

        $featuredProducts = Product::where('status',1)
            ->where('is_featured',1)->latest()->take(6)->get();

        $hotDeals = Product::where('status',1)
            ->where('is_hot_deal',1)->latest()->take(6)->get();

        $topSelling = Product::where('status',1)
            ->where('is_top_selling',1)->latest()->take(6)->get();

        return view('home', compact(
            'featuredProducts','hotDeals','topSelling'
        ));
    }
}
