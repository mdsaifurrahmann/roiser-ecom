<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientRoutes;
use App\Http\Controllers\Dashboard;

Route::controller(ClientRoutes::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('shop', 'shop')->name('shop');
    Route::get('product', 'productDetails')->name('productDetails');
    Route::get('contact', 'contact')->name('contact');
    Route::get('about', 'about')->name('about');
    //    Route::get('blog', 'blog')->name('blog');
    Route::get('cart', 'cart')->name('cart');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('wishlist', 'wishlist')->name('wishlist');
    Route::get('login', 'login')->name('login');
    Route::get('register', 'register')->name('register');
});

Route::controller(Dashboard::class)->group(function () {

    Route::prefix('panel')->middleware('auth')->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });
});
