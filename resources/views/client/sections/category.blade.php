<section class="category-section pt-100 pb-100">
    <div class="container">
        <div class="category-top heading-space space-border">
            <div class="section-heading mb-0">
                <h2 class="section-title">Best for your categories</h2>
                <p>29 categories belonging to a total 15,892 products</p>
            </div>
            <!-- Carousel Arrows -->
            <div class="swiper-arrow">
                <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-left"></i></div>
                <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-right"></i></div>
            </div>
        </div>
        <div class="category-carousel swiper">
            <div class="swiper-wrapper">

                @foreach ($categorySlider as $category)
                    <x-category-item category_name="{{ $category->name }}"
                                     category_img="{{Storage::url('products/categories/'.$category->image)}}"
                                     category_route="{{route('page', $category->slug)}}"/>
                @endforeach


                {{--                <x-category-item category_name="Shoes Collection" category_img="assets/img/images/cate-2.png" category_route="shop" />--}}
                {{--                <x-category-item category_name="Watch" category_img="assets/img/images/cate-3.png" category_route="shop" />--}}
                {{--                <x-category-item category_name="Accessories" category_img="assets/img/images/cate-4.png" category_route="shop" />--}}
                {{--                <x-category-item category_name="Sunglasses" category_img="assets/img/images/cate-5.png" category_route="shop" />--}}
                {{--                <x-category-item category_name="Women Wear" category_img="assets/img/images/cate-6.png" category_route="shop" />--}}

            </div>
        </div>
    </div>
</section>
<!-- ./ category-section -->
