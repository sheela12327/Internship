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
           Categories (only those with products)
        ==========================*/
        $categories = Category::all();

        /* =========================
           Dynamic Product Sections
        ==========================*/
        $featuredProducts = Product::active()
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $hotDeals = Product::active()
            ->where('is_hot_deal', 1)
            ->latest()
            ->take(6)
            ->get();

        $topSelling = Product::active()
            ->topSelling()
            ->latest()
            ->take(6)
            ->get();

        /* =========================
           Products Grouped by Category
        ==========================*/
        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category->slug] = $category->products()
                ->active()
                ->latest()
                ->take(6)
                ->get();
        }

        /* =========================
           Static Featured Products
        ==========================*/
        $staticFeatured = [
            [
                'name' => 'Hair Clips',
                'category' => 'Accessories',
                'price' => 250,
                'old_price' => 300,
                'image' => 'frontend/img/product02.png',
                'rating' => 4
            ],
            [
                'name' => 'T-shirt',
                'category' => 'Summer collection',
                'price' => 150,
                'old_price' => 250,
                'image' => 'frontend/img/product04.png',
                'rating' => 5
            ],
            [
                'name' => 'Ladies T-shirt',
                'category' => 'Summer collection',
                'price' => 200,
                'old_price' => 300,
                'image' => 'frontend/img/product05.png',
                'rating' => 5
            ]
        ];

        /* =========================
           Static Top Selling Products
        ==========================*/
        $staticTopSelling = [
            [
                'name' => 'Product 6',
                'category' => 'Category',
                'price' => 980,
                'old_price' => 990,
                'image' => 'frontend/img/product06.png',
                'rating' => 5
            ],
            [
                'name' => 'Product 7',
                'category' => 'Category',
                'price' => 980,
                'old_price' => 990,
                'image' => 'frontend/img/product07.png',
                'rating' => 4
            ],
            [
                'name' => 'Product 8',
                'category' => 'Category',
                'price' => 980,
                'old_price' => 990,
                'image' => 'frontend/img/product08.png',
                'rating' => 0
            ]
        ];

        /* =========================
           Pass everything to the view
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
