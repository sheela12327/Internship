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

    public function index1()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Fetch all categories
        $categories = Category::all();

        // Featured, Hot Deals, Top Selling
        $featuredProducts = Product::active()->where('is_featured', 1)->latest()->take(6)->get();
        $hotDeals = Product::active()->where('is_hot_deal', 1)->latest()->take(6)->get();
        $topSelling = Product::active()->where('is_top_selling', 1)->latest()->take(6)->get();

        // Products grouped by category dynamically
        $productsByCategory = [];
        foreach ($categories as $category) {
            $key = strtolower($category->slug); // or use name
            $productsByCategory[$key] = Product::active()
                ->where('category_id', $category->id)
                ->take(6)
                ->get();
        }

        return view('home', compact(
            'categories',
            'featuredProducts',
            'hotDeals',
            'topSelling',
            'productsByCategory'
        ));
    }

}
