<?php

use Illuminate\Support\Facades\Route;

//route
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\CartPageController;
use App\Http\Controllers\AuthPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.master_front');
// });

Route::get('/', [FrontPageController::class, 'index'])->name('front.index');

Route::get('/products', [ProductPageController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductPageController::class, 'detail'])->name('product.detail');
Route::get('/cart', [CartPageController::class, 'index'])->name('cart.index');
Route::get('/authentication', [AuthPageController::class, 'index'])->name('auth.index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
