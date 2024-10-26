<?php

namespace App\Http\Controllers;

use App\Models\Products\Products;
use App\Models\Products\ProductsCategory;

class ClientRoutes extends Controller
{

    public function home()
    {
        $categorySlider = ProductsCategory::where('visibility', 1)->where('status', 1)->where('featured', 1)->take(8)->get();

        return view('client.home', [
            'categorySlider' => $categorySlider
        ]);
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
        $products = Products::where('status', 1)->with('category', 'variants')->paginate(24);

        return view('client.shop', [
            'products' => $products
        ]);
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

    public function productDetails($slug)
    {
        $product = Products::where('slug', $slug)->with(['category', 'variants.color', 'variants.size', 'sizeGuide'])->first();

        return view('client.product-details', [
            'product' => $product
        ]);
    }

    public function blogDetails()
    {
        return view('client.blog-details');
    }


    public function page($slug)
    {

        $category = ProductsCategory::where('slug', $slug)->select('id', 'name', 'image')->first();

        $products = Products::where('category_id', $category->id)->orWhere('sub_category_id', $category->id)->where('status', 1)->with('category', 'variants')->paginate(20);

        return view('client.page', [
            'products' => $products,
            'category' => $category
        ]);

    }
}
