@extends('layouts.client')

@section('body')

    <section class="checkout-section pt-60 pb-60">
        <div class="container">
            <h2 class="section-title text-center mb-30">Checkout</h2>
            <div class="checkout-top">
                <div class="coupon-list">
                    <div class="verify-item mb-30">
                        <h4 class="title">Returning customers?<button type="button" class="rr-checkout-login-form-reveal-btn">Click here</button> to login</h4>
                        <div id="rrReturnCustomerLoginForm" class="login-form">
                            <form action="mail.php">
                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Phone Number">
                                <input type="text" id="password" name="password" class="form-control" placeholder="Password">
                            </form>
                            <div class="checkbox-wrap">
                                <div class="checkbox-item">
                                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                    <label for="vehicle3">Remember Me</label>
                                </div>
                                <a href="#" class="forgot">Forgot Password?</a>
                            </div>
                            <button class="rr-primary-btn">Login</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="checkout-left">
                        <h3 class="form-header">Billing Details</h3>
                        <form action="mail.php">
                            <div class="checkout-form-wrap">

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item name">
                                            <h4 class="form-title">Full Name*</h4>
                                            <input type="text" id="fullname-2" name="fullname-2" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item ">
                                            <h4 class="form-title">Address</h4>
                                            <input type="text" id="street" name="street" class="form-control street-control" placeholder="House number and street number">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">Town / City*</h4>
                                            <input type="text" id="town" name="town" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">Phone*</h4>
                                            <input type="text" id="phone" name="phone" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">Order Notes*</h4>
                                            <textarea id="message" name="message" cols="30" rows="5" class="form-control address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="checkout-right">
                        <h3 class="form-header">Your Order</h3>
                        <div class="order-box">
                            <div class="order-items">
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="product">Product</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="price">Price</span>
                                    </div>
                                </div>
                                <div class="order-item">
                                    <div class="order-left">
                                        <div class="order-img"><img src="assets/img/shop/cart-img-1.png" alt="img"></div>
                                    </div>
                                    <div class="order-right">
                                        <div class="content">
                                            <span class="category">Headphone</span>
                                            <h4 class="title">Surge Shield Safeguard</h4>
                                        </div>
                                        <span class="price">$500.00</span>
                                    </div>
                                </div>
                                <div class="order-item">
                                    <div class="order-left">
                                        <div class="order-img"><img src="assets/img/shop/cart-img-2.png" alt="img"></div>
                                    </div>
                                    <div class="order-right">
                                        <div class="content">
                                            <span class="category">Ups System</span>
                                            <h4 class="title">Nova Sound Elegance</h4>
                                        </div>
                                        <span class="price">$500.00</span>
                                    </div>
                                </div>
                                <div class="order-item">
                                    <div class="order-left">
                                        <div class="order-img"><img src="assets/img/shop/cart-img-3.png" alt="img"></div>
                                    </div>
                                    <div class="order-right">
                                        <div class="content">
                                            <span class="category">Headset Mic</span>
                                            <h4 class="title">Pure Pod Harmony</h4>
                                        </div>
                                        <span class="price">$500.00</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">Subtotal</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title">$500.00</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">Subtotal</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title">$500.00</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">Shipping</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title"><span>Flat rate:</span>$50.00</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">Total Price:</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title title-2">$550.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-option-wrap">
                                <div class="payment-option">
                                    <div class="shipping-option">
                                        <div class="options">
                                            <input id="flat_rate" type="radio" name="shipping">
                                            <label for="flat_rate">Direct Bank Transfer</label>
                                        </div>
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="local_pickup" type="radio" name="shipping">
                                        <label for="local_pickup">Check Payments</label>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="free_shipping" type="radio" name="shipping">
                                        <label for="free_shipping">Cash On Delivery</label>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="paypal" type="radio" name="shipping">
                                        <label for="paypal">Paypal</label>
                                    </div>
                                </div>
                                <p class="desc">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <span>privacy policy.</span></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I have read and agree terms and conditions *
                                    </label>
                                </div>
                                <button class="rr-primary-btn order-btn">Place Your Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ checkout-section -->

@endsection
