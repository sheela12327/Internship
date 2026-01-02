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

        // Redirect admin to dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        /* =========================
           Fetch Categories
        ==========================*/
        $categories = Category::all();

        /* =========================
           Dynamic Products
        ==========================*/
        $featuredProducts = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(6)
            ->get();

        $hotDeals = Product::where('is_active', 1)
            ->where('is_hot_deal', 1)
            ->latest()
            ->take(6)
            ->get();

        $topSelling = Product::where('is_active', 1)
            ->where('is_top_selling', 1)
            ->latest()
            ->take(6)
            ->get();

        /* =========================
           Products grouped by category
        ==========================*/
        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category->slug] = $category->products()
                ->where('is_active', 1)
                ->latest()
                ->take(6)
                ->get();
        }

        /* =========================
           Static Products (optional)
        ==========================*/
        $staticFeatured = [
            // [
            //     'name' => 'T-shirt',
            //     'category' => 'Summer collection',
            //     'price' => 150,
            //     'old_price' => 250,
            //     'image' => 'frontend/img/product04.png',
            //     'rating' => 5
            // ],
            // [
            //     'name' => 'Ladies T-shirt',
            //     'category' => 'Summer collection',
            //     'price' => 200,
            //     'old_price' => 300,
            //     'image' => 'frontend/img/product05.png',
            //     'rating' => 5
            // ]
        ];

        $staticTopSelling = [
            // [
            //     'name' => 'Product 6',
            //     'category' => 'Category',
            //     'price' => 980,
            //     'old_price' => 990,
            //     'image' => 'frontend/img/product06.png',
            //     'rating' => 5
            // ],
            // [
            //     'name' => 'Product 7',
            //     'category' => 'Category',
            //     'price' => 980,
            //     'old_price' => 990,
            //     'image' => 'frontend/img/product07.png',
            //     'rating' => 4
            // ],
            // [
            //     'name' => 'Product 8',
            //     'category' => 'Category',
            //     'price' => 980,
            //     'old_price' => 990,
            //     'image' => 'frontend/img/product08.png',
            //     'rating' => 0
            // ]
        ];

        /* =========================
           Return view with all data
        ==========================*/
        return view('home', compact(
            'categories',
            'featuredProducts',
            'hotDeals',
            'topSelling',
            'productsByCategory',
            'staticFeatured',
            'staticTopSelling'
        ));
    }
}
