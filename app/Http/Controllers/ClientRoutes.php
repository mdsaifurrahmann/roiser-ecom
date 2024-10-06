<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientRoutes extends Controller
{

    public function home()
    {
        return view('client.home');
    }

    public function wishlist()
    {
        return view('client.wishlist');
    }

    public function login()
    {
        return view('client.login');
    }

    public function register()
    {
        return view('client.register');
    }

//    public function forgotPassword()
//    {
//        return view('client.forgot-password');
//    }

    public function myAccount()
    {
        return view('client.my-account');
    }

    public function shop()
    {
        return view('client.shop');
    }

    public function contact()
    {
        return view('client.contact');
    }

    public function about()
    {
        return view('client.about');
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function cart()
    {
        return view('client.cart');
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function productDetails()
    {
        return view('client.product-details');
    }

    public function blogDetails()
    {
        return view('client.blog-details');
    }
}
