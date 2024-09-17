@extends('layouts.client')

@section('body')

    <section class="cart-section pt-60 pb-90">
        <div class="container">
            <h2 class="text-center section-title mb-30">Wishlist</h2>
            <div class="table-content cart-table table-2">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="product-remove"></th>
                        <th class="cart-product-name text-center">Product name</th>
                        <th class="product-price"> Price</th>
                        <th class="product-quantity">Stock Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="product-remove"><button><i class="fa-sharp fa-regular fa-xmark"></i></button></td>
                        <td class="product-thumbnail">
                            <a href="shop-details.html">
                                <img src="assets/img/shop/cart-img-1.png" alt="img">
                            </a>
                            <div class="product-thumbnail">
                                <span class="category">Headphone</span>
                                <h4 class="title">Power Guard Fortress</h4>
                            </div>
                        </td>
                        <td class="product-price"><span class="amount">$550.00</span></td>
                        <td class="product-quantity">
                            <span>Out of stock</span>
                        </td>
                        <td class="product-subtotal"><button class="rr-primary-btn">Add to cart</button></td>
                    </tr>
                    <tr>
                        <td class="product-remove"><button><i class="fa-sharp fa-regular fa-xmark"></i></button></td>
                        <td class="product-thumbnail">
                            <a href="shop-details.html">
                                <img src="assets/img/shop/cart-img-2.png" alt="img">
                            </a>
                            <div class="product-thumbnail">
                                <span class="category">Ups System</span>
                                <h4 class="title">Quantum Sound Enigma</h4>
                            </div>
                        </td>
                        <td class="product-price"><span class="amount">$550.00</span></td>
                        <td class="product-quantity">
                            <span>Out of stock</span>
                        </td>
                        <td class="product-subtotal"><button class="rr-primary-btn">Add to cart</button></td>
                    </tr>
                    <tr>
                        <td class="product-remove"><button><i class="fa-sharp fa-regular fa-xmark"></i></button></td>
                        <td class="product-thumbnail">
                            <a href="shop-details.html">
                                <img src="assets/img/shop/cart-img-3.png" alt="img">
                            </a>
                            <div class="product-thumbnail">
                                <span class="category">Ups System</span>
                                <h4 class="title">Quantum Sound Enigma</h4>
                            </div>
                        </td>
                        <td class="product-price"><span class="amount">$550.00</span></td>
                        <td class="product-quantity">
                            <span>Out of stock</span>
                        </td>
                        <td class="product-subtotal"><button class="rr-primary-btn">Add to cart</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- ./ cart-section -->

@endsection
