@extends('layouts.client')

@section('title', $product->name ? $product->name : 'Product Details')

@section('body')

    <section class="shop-section single pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 product-details-wrap">
                    <div class="product-slider-wrap">
                        <div class="swiper product-gallary-thumb">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="thumb-item">
                                        <img src="{{ Storage::url('products/media/'.$product->thumbnail) }}" alt="shop">
                                    </div>
                                </div>

                                @if($product->variants[0]->media)
                                    @foreach($product->variants[0]->media as $key => $image)
                                        <div class="swiper-slide">
                                            <div class="thumb-item">
                                                <img src="{{ Storage::url('products/media/'.$image) }}" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="swiper product-gallary">
                            <span class="sale">Sale</span>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="gallary-item">
                                        <img src="{{ Storage::url('products/media/'.$product->thumbnail) }}" alt="shop">
                                    </div>
                                </div>


                                @if($product->variants[0]->media)
                                    @foreach($product->variants[0]->media as $key => $image)
                                        <div class="swiper-slide">
                                            <div class="gallary-item">
                                                <img src="{{ Storage::url('products/media/'.$image) }}" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <div class="swiper-nav-next"><i class="las la-arrow-right"></i></div>
                            <div class="swiper-nav-prev"><i class="las la-arrow-left"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details">
                        <div class="product-info">
                            <div class="product-inner">
                                <span class="category">{{$product->category->name}}</span>
                                <h3 class="title">{{$product->name}}</h3>
                                <div class="rating-wrap">
                                    <ul class="rating">
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                    </ul>
                                    <span>(1 customer review)</span>
                                </div>
                                <h4 class="price">${{$product->variants[0]->sale_price}} <span>${{$product->variants[0]->price}}</span></h4>
                                <div class="product-desc-wrap">
                                    <p class="desc">Eget taciti odio cum habitant egestas conubia turpis phasellus, ante parturient <br>
                                        donec duis primis nam faucibus augue malesuada venenatis</p>
                                    <span class="view-text">
                                        <i class="fa-sharp fa-regular fa-eye"></i>28 people are viewing this right now
                                    </span>
                                </div>
                                <div class="item-left-line">
                                    <span>Only 15 items left in stock!</span>
                                    <div class="line"></div>
                                </div>
                                <ul class="details-list">
                                    <li><i class="fa-light fa-arrow-right-arrow-left"></i>Free returns</li>
                                    <li><i class="fa-light fa-truck"></i>Free shipping via DHL, fully insured</li>
                                    <li><i class="fa-light fa-circle-check"></i>All taxes and customs duties included</li>
                                </ul>
                            </div>
                            <div class="product-btn">
                                <form>
                                    <input type="number" name="age" id="age" min="1" max="100" step="1" value="1">
                                </form>
                                <div class="cart-btn-wrap-2"><a href="#" class="rr-primary-btn cart-btn">Add To Cart</a></div>
                            </div>
                            <a href="{{route('checkout')}}" class="shop-details-btn rr-primary-btn">Buy The Item Now</a>
                            <ul class="product-meta">
                                <li><a href="#">Compare</a></li>
                                <li><a href="#">Ask a question</a></li>
                                <li><a href="#">Share</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Shop Section-->

    <section class="product-description pb-100">
        <div class="container">
            <ul class="nav tab-navigation" id="product-tab-navigation" role="tablist">
                <li role="presentation">
                    <button class="active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                            role="tab" aria-controls="home" aria-selected="true">Description</button>
                </li>
                <li role="presentation">
                    <button id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">Size Guide
                    </button>
                </li>
                <li role="presentation">
                    <button id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab"
                            aria-controls="contact" aria-selected="false">Reviews (3)
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="product-tab-content">
                <div class="tab-pane fade show active description" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="desc-wrap">
                        <div class="left-content">
                            <p class="mb-30">
                                {!! $product->description !!}
                            </p>
                        </div>
                        {{--                        <div class="right-content">--}}
                        {{--                            <img src="assets/img/shop/shop-details-img.jpg" alt="">--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <img src="{{ Storage::url('products/size-guides/'.$product->sizeGuide->image) }}" alt="">

                    {{--                    <table class="table product-table">--}}
                    {{--                        <thead>--}}
                    {{--                        <tr>--}}
                    {{--                            <th scope="col">Size</th>--}}
                    {{--                            <th scope="col">Bust</th>--}}
                    {{--                            <th scope="col">Waist</th>--}}
                    {{--                            <th scope="col">Hip</th>--}}
                    {{--                        </tr>--}}
                    {{--                        </thead>--}}
                    {{--                        <tbody>--}}
                    {{--                        <tr>--}}
                    {{--                            <td>S</td>--}}
                    {{--                            <td>34 -36</td>--}}
                    {{--                            <td>28-30</td>--}}
                    {{--                            <td>38-40</td>--}}
                    {{--                        </tr>--}}
                    {{--                        <tr>--}}
                    {{--                            <td>M</td>--}}
                    {{--                            <td>36 -38</td>--}}
                    {{--                            <td>30-32.5</td>--}}
                    {{--                            <td>40-43</td>--}}
                    {{--                        </tr>--}}
                    {{--                        <tr>--}}
                    {{--                            <td>L</td>--}}
                    {{--                            <td>38-40</td>--}}
                    {{--                            <td>32-34.5</td>--}}
                    {{--                            <td>42-45.5</td>--}}
                    {{--                        </tr>--}}
                    {{--                        <tr>--}}
                    {{--                            <td>XL</td>--}}
                    {{--                            <td>40-42</td>--}}
                    {{--                            <td>35-37</td>--}}
                    {{--                            <td>46-38</td>--}}
                    {{--                        </tr>--}}
                    {{--                        </tbody>--}}
                    {{--                    </table>--}}
                </div>
                <div class="tab-pane fade review" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row product-review gy-lg-0 gy-4">
                        <div class="col-lg-5 col-md-12">
                            <div class="reviewr-wrap">
                                <div class="review-list">
                                    <div class="review-item">
                                        <div class="review-thumb">
                                            <img src="assets/img/shop/review-list-1.jpg" alt="img">
                                        </div>
                                        <div class="content">
                                            <div class="content-top">
                                                <h4 class="name">Eleanor Fant <span>06 March, 2023</span></h4>
                                                <ul class="review">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <p>Designed very similarly to the nearly double priced Galaxy tab S6, with the only removal being.</p>
                                        </div>
                                    </div>
                                    <div class="review-item">
                                        <div class="review-thumb">
                                            <img src="assets/img/shop/review-list-2.jpg" alt="img">
                                        </div>
                                        <div class="content">
                                            <div class="content-top">
                                                <h4 class="name">Haliey White <span>06 March, 2023</span></h4>
                                                <ul class="review">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <p>Designed very similarly to the nearly double priced Galaxy tab S6, with the only removal being.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="review-form-wrap">
                                <h4 class="title">Review this product</h4>
                                <span class="publish">Your email address will not be published. Required fields are marked *</span>
                                <div class="review-box">
                                    <span>Your ratings :</span>
                                    <ul class="review">
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                        <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="blog-contact-form form-2 review-form">
                                    <div class="request-form">
                                        <form action="contact.php" method="post" id="ajax_contact" class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-item">
                                                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Your Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-item">
                                                        <input type="text" id="email" name="email" class="form-control" placeholder="Your Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-item message-item">
                                                        <textarea id="message" name="message" cols="30" rows="5" class="form-control address" placeholder="Comment"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox-wrap">
                                                <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                                <label for="vehicle3">Save my name, email, and website in this browser for the next time I comment.</label><br>
                                            </div>
                                            <div class="submit-btn">
                                                <button id="submit" class="rr-primary-btn" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Product Description-->

@endsection
