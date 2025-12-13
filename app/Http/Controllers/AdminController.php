<?php

namespace App\Http\Controllers;

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
        return view('admin.dashboard'); // create this Blade view
    }
}
