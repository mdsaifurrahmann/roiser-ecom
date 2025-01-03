@props([
    'product_name' => "Monica Diara Party Dress",
    'image' => "assets/img/shop/shop-1.png",
    'category' => "Levi’sotton",
    'offer' => "250.00",
    'price' => "157.00",
    'details' => "shop",
    'label' => null,
    'reviews' => null
])

<div class="shop-item">
    <div class="shop-thumb">
        <div class="overlay"></div>
        <img src="{{ $image }}" alt="{{ $product_name }}">
        @if($label)
            <span class="sale">{{ $label }}</span>
        @endif
        <ul class="shop-list">
            <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
            <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
            {{--            <li><a href="#"><i class="fa-light fa-eye"></i></a></li>--}}
        </ul>
    </div>
    <div class="shop-content">
        <span class="category">{{ $category }}</span>
        <h3 class="title"><a href="{{ $details }}">{{ $product_name }}</a></h3>
        @if($reviews)
            <div class="review-wrap">
                <ul class="review">
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                </ul>
                <span>({{ $reviews }} Reviews)</span>
            </div>
        @endif
        <span class="price">{{ $offer ?? null }} <span class="offer ms-2" style="font-size: 12px">{{ $price }}</span>
        </span>
    </div>
</div>
