<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'auth.index']);
    }

    public function index()
    {
        return view('pages.front.auth', ['headerColor' => true]);
    }
}
