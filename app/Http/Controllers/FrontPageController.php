<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontPageController extends Controller
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $lastestProduct = $this->product->orderBy('rating', 'DESC')->limit(8)->get();
        // dd($lastestProduct);
        return view('pages.front.landing', [
            'landing' => true, 
            'headerColor' => true,
            'lastestProduct' => $lastestProduct]);
    }
}
