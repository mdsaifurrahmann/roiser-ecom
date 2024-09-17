@props([
    'product_name' => "Hillshire Farm Thin Sliced Honey Deli Lunch Meat",
    'quantity' => "9 oz Pack",
    'price' => "$257.00",
    'offer' => "$450.00",
    'category' => "Nescafe USA",
    'image' => "assets/img/product/popular-1.png",
    'cart' => "cart",
    'details' => "shop"
])

<div class="product-item product-item-2">
{{--    <div class="time"><span>Delivery 9 MINS</span></div>--}}
    <ul class="product-list">
        <li><a href="#"><i class="fa-sharp fa-regular fa-plus"></i></a></li>
        <li><a href="#"><i class="fa-regular fa-heart"></i></a></li>
        <li><a href="#"><i class="fa-solid fa-arrow-right-arrow-left"></i></a></li>
    </ul>
    <div class="product-thumb">
        <img src="{{ $image }}" alt="{{ $product_name }}">
    </div>
    <div class="product-content">
        <span class="category">{{ $category }}</span>
        <h3 class="title"><a href="{{ route($details) }}">{{ $product_name }}</a></h3>
        <h4 class="quantity">{{ $quantity }}</h4>
        <span class="price">{{ $price }} <span class="offer">{{ $offer }}</span></span>
    </div>
    <div class="product-bottom">
        <a href="{{ route($cart) }}">Add To Cart</a>
    </div>
</div>
