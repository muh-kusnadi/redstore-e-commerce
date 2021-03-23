<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index()
    {
        return view('pages.front.products');
    }

    public function detail($id)
    {
        return view('pages.front.product_details');
    }
}
