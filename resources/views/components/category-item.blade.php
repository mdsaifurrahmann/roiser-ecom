@props([
    'category_name' => "Women Wear",
    'category_img' => "assets/img/images/cate-1.png",
    'category_route' => "shop"
])
<div class="swiper-slide">
    <div class="category-item">
        <div class="category-img">
            <img src="{{ $category_img }}" alt="{{ $category_name }}">
        </div>
        <h3 class="title"><a href="{{route($category_route)}}">{{ $category_name }}</a></h3>
    </div>
</div>
