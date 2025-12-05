<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'categories'=>Category::take(3)->get(),
            'newProducts'=>Product::latest()->take(10)->get(),
            'topSelling'=>Product::orderBy('created_at', 'desc')->take(10)->get(),
            'hotDeals' => Product::take(5)->get(),
        ]);
    }
}
