<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ShopNewController extends Controller
{
    public function index()
    {
        /* =========================
           Fetch Categories
        ==========================*/
        $categories = Category::all();

        /* =========================
           Featured Products by Category
        ==========================*/
        $featuredByCategory = [];
        $hotDealsByCategory = [];
        $topSellingByCategory = [];

        foreach ($categories as $category) {

            $featuredByCategory[$category->id] = $category->products()
                ->where('is_active', 1)
                ->where('is_featured', 1)
                ->latest()
                ->take(8)
                ->get();

            $hotDealsByCategory[$category->id] = $category->products()
                ->where('is_active', 1)
                ->where('is_hot_deal', 1)
                ->latest()
                ->take(8)
                ->get();

            $topSellingByCategory[$category->id] = $category->products()
                ->where('is_active', 1)
                ->where('is_top_selling', 1)
                ->latest()
                ->take(8)
                ->get();
        }

        /* =========================
           Return Shop View
        ==========================*/
        return view('frontend.shop.index', compact(
            'categories',
            'featuredByCategory',
            'hotDealsByCategory',
            'topSellingByCategory'
        ));
    }
}
