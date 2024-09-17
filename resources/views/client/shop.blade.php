@extends('layouts.client')

@section('body')
    <section class="shop-grid pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="shop-grid-left">
                        <div class="top-grid-content">
                            <div class="shop-tab-nav">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true">
                                            <svg width="20" height="17" viewBox="0 0 20 17"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="15" width="5" height="3" fill="currentColor" />
                                                <rect x="15" y="7" width="5" height="3" fill="currentColor" />
                                                <rect x="15" y="14" width="5" height="3" fill="currentColor" />
                                                <rect x="7.71875" width="5" height="3" fill="currentColor" />
                                                <rect x="7.71875" y="7" width="5" height="3" fill="currentColor" />
                                                <rect x="7.71875" y="14" width="5" height="3"
                                                    fill="currentColor" />
                                                <rect width="5" height="3" fill="currentColor" />
                                                <rect y="7" width="5" height="3" fill="currentColor" />
                                                <rect y="14" width="5" height="3" fill="currentColor" />
                                            </svg>

                                        </button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">
                                            <svg width="20" height="17" viewBox="0 0 20 17"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="5.71875" width="14.2857" height="3" fill="currentColor" />
                                                <rect x="5.71875" y="7" width="14.2857" height="3"
                                                    fill="currentColor" />
                                                <rect x="5.71875" y="14" width="14.2857" height="3"
                                                    fill="currentColor" />
                                                <rect width="3.80952" height="3" fill="currentColor" />
                                                <rect y="7" width="3.80952" height="3" fill="currentColor" />
                                                <rect y="14" width="3.80952" height="3" fill="currentColor" />
                                            </svg>
                                        </button>
                                    </div>
                                </nav>
                                <span>Showing 1–12 of 88 results</span>
                            </div>
                            <div class="nice-select shop-select country" tabindex="0">
                                <span class="current">Default Shorting</span>
                                <ul class="list">
                                    <li data-value="" class="option selected focus">Default Shorting</li>
                                    <li data-value="vdt" class="option">Most Popular</li>
                                    <li data-value="can" class="option">Date</li>
                                    <li data-value="uk" class="option">Tranding</li>
                                    <li data-value="dk" class="option">Featured</li>
                                    <li data-value="dl" class="option">Discounted</li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="row gy-4">
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-1.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-2.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-3.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-4.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-13.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-14.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-7.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-8.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-9.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-10.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-11.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <x-shop-item product_name="Monica Diara Party Dress"
                                            image="assets/img/shop/shop-12.png" category="Levi’sotton" offer="$250.00"
                                            price="$157.00" details="productDetails" label="New" reviews="15" />
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="shop-sidebar">
                        <h3 class="sidebar-header">Categories</h3>
                        <ul class="sidebar-list">
                            <li>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                <label for="vehicle1"> Accessories (4)</label><br>
                            </li>
                            <li>
                                <input type="checkbox" id="vehicle3" name="vehicle1" value="Bike">
                                <label for="vehicle3"> Badge Categories (4)</label><br>
                            </li>
                            <li>
                                <input type="checkbox" id="vehicle4" name="vehicle1" value="Bike">
                                <label for="vehicle4"> Bag & Backpacks (1)</label><br>
                            </li>
                            <li>
                                <input type="checkbox" id="vehicle5" name="vehicle1" value="Bike">
                                <label for="vehicle5"> Category Grid (12)</label><br>
                            </li>
                            <li>
                                <input type="checkbox" id="vehicle6" name="vehicle1" value="Bike">
                                <label for="vehicle6"> Clothing & Apparel (2)</label><br>
                            </li>
                            <li>
                                <input type="checkbox" id="vehicle7" name="vehicle1" value="Bike">
                                <label for="vehicle7"> Consumer Electric (3)</label><br>
                            </li>
                            <li>
                                <input type="checkbox" id="vehicle8" name="vehicle1" value="Bike">
                                <label for="vehicle8"> Top Electronics (3)</label><br>
                            </li>
                            <li>
                                <input type="checkbox" id="vehicle9" name="vehicle1" value="Bike">
                                <label for="vehicle9"> Women's Collection (5)</label><br>
                            </li>
                        </ul>
                    </div>
                    <div class="shop-sidebar">
                        <h3 class="sidebar-header">Filter by price</h3>
                        <div class="filter-box">
                            <div class="range-slider">
                                <input type="range" min="20" max="500" value="300" id="price-range">
                                <div class="slider-line"></div>
                                <div class="range-slider-output">
                                    <h3 class="price">Price: $10 — $90</h3>
                                    <h3 id="price-output" class="price">$<span>500</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-sidebar">
                        <h3 class="sidebar-header">Item Size</h3>
                        <div class="radion-btn-area">
                            <div class="radio-item">
                                <label for="radio-1">
                                    <input type="radio" id="radio-1" name="flavor" value="vanilla">
                                    <span class="size">XL</span>
                                </label>
                                <span class="number">(15)</span>
                            </div>
                            <div class="radio-item">
                                <label for="radio-2">
                                    <input type="radio" id="radio-2" name="flavor" value="vanilla">
                                    <span class="size">S</span>
                                </label>
                                <span class="number">(15)</span>
                            </div>
                            <div class="radio-item">
                                <label for="radio-3">
                                    <input type="radio" id="radio-3" name="flavor" value="vanilla">
                                    <span class="size">Small</span>
                                </label>
                                <span class="number">(15)</span>
                            </div>
                            <div class="radio-item">
                                <label for="radio-4">
                                    <input type="radio" id="radio-4" name="flavor" value="vanilla">
                                    <span class="size">L</span>
                                </label>
                                <span class="number">(15)</span>
                            </div>
                            <div class="radio-item">
                                <label for="radio-5">
                                    <input type="radio" id="radio-5" name="flavor" value="vanilla">
                                    <span class="size">XL</span>
                                </label>
                                <span class="number">(15)</span>
                            </div>
                            <div class="radio-item">
                                <label for="radio-6">
                                    <input type="radio" id="radio-6" name="flavor" value="vanilla">
                                    <span class="size">Extra Large</span>
                                </label>
                                <span class="number">(15)</span>
                            </div>
                        </div>
                    </div>
                    <div class="shop-sidebar">
                        <h3 class="sidebar-header">Brands</h3>
                        <ul class="sidebar-list list-2">
                            <li>
                                <div class="left-item">
                                    <input type="checkbox" id="vehicle-a" name="vehicle1" value="Bike">
                                    <label for="vehicle-a"> Juliate</label><br>
                                </div>
                                <span class="number">(15)</span>
                            </li>
                            <li>
                                <div class="left-item">
                                    <input type="checkbox" id="vehicle-e" name="vehicle1" value="Bike">
                                    <label for="vehicle-e"> H&M</label><br>
                                </div>
                                <span class="number">(15)</span>
                            </li>
                            <li>
                                <div class="left-item">
                                    <input type="checkbox" id="vehicle-b" name="vehicle1" value="Bike">
                                    <label for="vehicle-b"> Harmoni</label><br>
                                </div>
                                <span class="number">(15)</span>
                            </li>
                            <li>
                                <div class="left-item">
                                    <input type="checkbox" id="vehicle-c" name="vehicle1" value="Bike">
                                    <label for="vehicle-c"> Sowat</label><br>
                                </div>
                                <span class="number">(15)</span>
                            </li>
                            <li>
                                <div class="left-item">
                                    <input type="checkbox" id="vehicle-f" name="vehicle1" value="Bike">
                                    <label for="vehicle-f"> MAcro</label><br>
                                </div>
                                <span class="number">(15)</span>
                            </li>
                        </ul>
                    </div>
                    <div class="shop-sidebar sticky-widget">
                        <h3 class="sidebar-header">Brands</h3>
                        <div class="sidebar-items">
                            <div class="sidebar-item">
                                <div class="item-img">
                                    <img src="assets/img/shop/sidebar-img-1.png" alt="img">
                                </div>
                                <div class="content">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <h4 class="title">Fancy Black Sunglass</h4>
                                    <span class="price"> <span class="offer">$450.00</span>$257.00</span>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <div class="item-img">
                                    <img src="assets/img/shop/sidebar-img-2.png" alt="img">
                                </div>
                                <div class="content">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <h4 class="title">D’valo Office Cotton</h4>
                                    <span class="price"> <span class="offer">$450.00</span>$257.00</span>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <div class="item-img">
                                    <img src="assets/img/shop/sidebar-img-3.png" alt="img">
                                </div>
                                <div class="content">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <h4 class="title">Black Flower Sandal</h4>
                                    <span class="price"> <span class="offer">$450.00</span>$257.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pagination-wrap mt-50">
                <li><a href="#">1</a></li>
                <li><a href="#" class="active">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="fa-regular fa-chevrons-right"></i></a></li>
            </ul>
        </div>
    </section>
    <!-- ./ Shop Grid -->
@endsection
