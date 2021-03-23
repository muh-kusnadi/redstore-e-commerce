<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartPageController extends Controller
{
    public function index()
    {
        return view('pages.front.cart');
    }
}
