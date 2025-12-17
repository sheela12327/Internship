<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Constructor to apply middleware
    public function __construct()
    {
        $this->middleware(['auth', 'admin']); // only authenticated admins
    }

    // Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalUsers'    => User::count(),
            'totalOrders'  => Order::count(),
        ]);
    }
}
