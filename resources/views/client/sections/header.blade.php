    <!-- header-area-start -->
    <header class="header header-2 sticky-active">
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-inner">
                    <div class="top-bar-left">
                        <ul class="top-left-list">
                            <li><a href="{{route('about')}}">About</a></li>
                            <li><a href="{{route("contact")}}">Contact</a></li>
                            <li><a href="{{route('wishlist')}}">Wishlist</a></li>
                            <li><a href="{{route('checkout')}}">Checkout</a></li>
                        </ul>
                    </div>
                    <div class="top-bar-right">
                        <span>Need Help? Call Us: <a href="tel:+258326821485">+258 3268 21485</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <div class="header-middle-inner">
                    <div class="header-middle-left">
                        <div class="header-logo d-lg-block">
                            <a href="{{route('home')}}">
                                <img src="{{asset("assets/img/logo/logo-2.png")}}" alt="Logo">
                            </a>
                        </div>
                        <div class="form-wrap">
{{--                            <div class="nice-select select-control country" tabindex="0">--}}
{{--                                <span class="current">Categories</span>--}}
{{--                                <ul class="list">--}}
{{--                                    <li data-value="" class="option selected focus">Categories</li>--}}
{{--                                    <li data-value="vdt" class="option">Fashion</li>--}}
{{--                                    <li data-value="can" class="option">Organic</li>--}}
{{--                                    <li data-value="uk" class="option">Furniture</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                            <div class="category-form-wrap">
                                <form class="header-form" action="mail.php">
                                    <input class="form-control" type="text" name="search" placeholder="Search for products, categories or brands">
                                    <button class="submit rr-primary-btn">Search<i class="fa-light fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="header-middle-right">
                        <ul class="contact-item-list">
                            <li>
                                <a href="{{route('wishlist')}}" class="icon">
                                    <i class="fa-sharp fa-regular fa-heart"></i>
                                </a>
                            </li>
                            <li><a href="{{route('login')}}" class="login-btn">Login</a></li>
                            <li>
                                <div class="header-cart-btn">
                                    <a href="{{route('cart')}}" class="icon">
                                        <i class="fa-light fa-bag-shopping"></i>
                                    </a>
                                    <span>$0.00</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="primary-header">
            <div class="container">
                <div class="primary-header-inner">
                    <div class="header-logo mobile-logo">
                        <a href="{{route('home')}}">
                            <img src="{{asset("assets/img/logo/logo-2.png")}}" alt="Logo">
                        </a>
                    </div>
                    <div class="header-menu-wrap">
                        <div class="mobile-menu-items">
                            <ul>
                                <li class="active">
                                    <a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="">
                                    <a href="{{route('shop')}}">Shop</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Women</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">men</a>
                                </li>

                                <li class="">
                                    <a href="javascript:void(0)">Blog</a>
                                </li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.header-menu-wrap -->
                    <div class="header-right-wrap">
                        <div class="header-right">
                            <span>Get 30% Discount Now <span>Sale</span></span>
                            <div class="header-right-item">
                                <a href="javascript:void(0)" class="mobile-side-menu-toggle"
                                ><i class="fa-sharp fa-solid fa-bars"></i
                                    ></a>
                            </div>
                        </div>
                        <!-- /.header-right -->
                    </div>
                </div>
                <!-- /.primary-header-inner -->
            </div>
        </div>
    </header>
    <!-- /.Main Header -->

    <div class="mobile-side-menu">
        <div class="side-menu-content">
            <div class="side-menu-head">
                <a href='{{route('home')}}'><img src="{{asset("assets/img/logo/logo-2.png")}}" alt="logo"></a>
                <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
            </div>
            <div class="side-menu-wrap"></div>
            <ul class="side-menu-list">
                <li><i class="fa-light fa-location-dot"></i>Address : <span>Amsterdam, 109-74</span></li>
                <li><i class="fa-light fa-phone"></i>Phone : <a href="tel:+01569896654">+01 569 896 654</a></li>
                <li><i class="fa-light fa-envelope"></i>Email : <a href="mailto:info@example.com">info@example.com</a></li>
            </ul>
        </div>
    </div>
    <!-- /.mobile-side-menu -->
