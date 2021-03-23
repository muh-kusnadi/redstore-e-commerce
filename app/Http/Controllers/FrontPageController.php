<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        return view('pages.front.landing', ['landing' => true, 'headerColor' => true]);
    }
}
