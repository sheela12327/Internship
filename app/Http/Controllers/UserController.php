<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     // List all users (exclude admins)
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // View user details + orders
    public function show($id)
    {
        $user = User::with('orders')->findOrFail($id);

        return view('admin.users.view', compact('user'));
    }

    // Delete user safely
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->orders()->count() > 0) {
            return back()->with('error', 'User has orders and cannot be deleted.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
