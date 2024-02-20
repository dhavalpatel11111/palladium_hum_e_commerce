<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('backend/admin/content');
});

Route::get('/', function () {
    return view('Frontend.index');
});


Route::get('/shop', function () {
    return view('Frontend.shop');
});

Route::get('/about', function () {
    return view('Frontend.about');
});

Route::get('/services', function () {
    return view('Frontend.services');
});

Route::get('/blog', function () {
    return view('Frontend.blog');
});

Route::get('/contact', function () {
    return view('Frontend.contact');
});

Route::get('/cart', function () {
    return view('Frontend.cart');
});

Route::get('/checkout', function () {
    return view('Frontend.checkout');
});
