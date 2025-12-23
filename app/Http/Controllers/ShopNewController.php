<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ShopNewController extends Controller
{
    //
     public function index()
    {
        $categories = Category::with([
            'products' => function ($q) {
                $q->where('is_active', 1)->latest();
            }
        ])->get();

        // Featured (grouped by category)
        $featuredByCategory = [];
        foreach ($categories as $category) {
            $featuredByCategory[$category->id] = $category->products
                ->where('is_featured', 1)
                ->take(8);
        }

        // Hot Deals (grouped by category)
        $hotDealsByCategory = [];
        foreach ($categories as $category) {
            $hotDealsByCategory[$category->id] = $category->products
                ->where('is_hot_deal', 1)
                ->take(8);
        }

        // Top Selling (grouped by category)
        $topSellingByCategory = [];
        foreach ($categories as $category) {
            $topSellingByCategory[$category->id] = $category->products
                ->where('is_top_selling', 1)
                ->take(8);
        }

        return view('frontend.shop.index', compact(
            'categories',
            'featuredByCategory',
            'hotDealsByCategory',
            'topSellingByCategory'
        ));
    }

}
