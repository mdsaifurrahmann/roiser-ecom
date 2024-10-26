<?php

use App\Http\Controllers\ClientRoutes;
use Illuminate\Support\Facades\Route;


Route::controller(ClientRoutes::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('shop', 'shop')->name('shop');
    Route::get('product/{slug}', 'productDetails')->name('product.details');
    Route::get('contact', 'contact')->name('contact');
    Route::get('about', 'about')->name('about');
    //    Route::get('blog', 'blog')->name('blog');
    Route::get('cart', 'cart')->name('cart');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('wishlist', 'wishlist')->name('wishlist');
    Route::get('login', 'login')->name('login-client');
    Route::get('register', 'register')->name('register');
    Route::get('{slug}', 'page')->name('page');
});

require_once __DIR__ . '/panel.php';