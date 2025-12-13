<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // only authenticated users
    }

    // Customer dashboard / home page
    public function index1()
    {
        $user = Auth::user();

        // Redirect admin to admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Normal customer view
        return view('home'); 
    }
}
