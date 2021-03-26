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

Route::get('/', [FrontPageController::class, 'index'])->name('front.index');

Route::get('/products', [ProductPageController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductPageController::class, 'detail'])->name('product.detail');
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartPageController::class, 'index'])->name('cart.index');
});

//auth
Route::get('/authentication', [AuthPageController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/authentication/register', [AuthPageController::class, 'postRegister'])->name('auth.register');
Route::post('/authentication/login', [AuthPageController::class, 'postLogin'])->name('auth.login');
Route::post('/authentication/logout', [AuthPageController::class, 'postLogout'])->name('auth.logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
