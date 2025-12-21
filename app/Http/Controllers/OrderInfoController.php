<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderInfoController extends Controller
{
    //
    public function index()
    {
        return view('frontend.order.index');

    }
}
