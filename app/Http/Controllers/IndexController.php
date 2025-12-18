<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        // Categories with active products
        $categories = Category::with(['products' => function($query) {
            $query->where('is_active', 1)->latest();
        }])->get();

        // Featured Products
        $featuredProducts = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(6)
            ->get();

        // Hot Deals
        $hotDeals = Product::where('is_active', 1)
            ->where('is_hot_deal', 1)
            ->latest()
            ->take(6)
            ->get();

        // Top Selling
        $topSelling = Product::where('is_active', 1)
            ->where('is_top_selling', 1)
            ->latest()
            ->take(6)
            ->get();

        // Products grouped by category
        $productsByCategory = [];
        foreach($categories as $category){
            $productsByCategory[$category->slug] = $category->products->take(6);
        }

        return view('frontend.index', compact(
            'categories',
            'featuredProducts',
            'hotDeals',
            'topSelling',
            'productsByCategory'
        ));
    }
}
