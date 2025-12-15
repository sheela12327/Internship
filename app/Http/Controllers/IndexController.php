<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        
        $categories = Category::where('status',1)->get();

        $featuredProducts = Product::where('status',1)
            ->where('is_featured',1)->latest()->take(6)->get();

        $hotDeals = Product::where('status',1)
            ->where('is_hot_deal',1)->latest()->take(6)->get();

        $topSelling = Product::where('status',1)
            ->where('is_top_selling',1)->latest()->take(6)->get();

        return view('frontend.index', compact(
            'featuredProducts','hotDeals','topSelling'
        ));
    }
}
