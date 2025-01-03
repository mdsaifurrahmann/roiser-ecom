<footer class="footer-section bg-grey pt-60" style="--rr-color-theme-primary: #67B02E">
    <div class="container">
        <div class="footer-items">
            <div class="footer-item">
                <div class="icon">
                    <img src="assets/img/icon/footer-1.png" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">Free Shipping</h4>
                    <span>Free shipping on orders over $65</span>
                </div>
            </div>
            <div class="footer-item">
                <div class="icon">
                    <img src="assets/img/icon/footer-2.png" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">Free Returns</h4>
                    <span>30-days free return polic</span>
                </div>
            </div>
            <div class="footer-item">
                <div class="icon">
                    <img src="assets/img/icon/footer-3.png" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">Secured Payments</h4>
                    <span>We accept all major credit card</span>
                </div>
            </div>
            <div class="footer-item item-2">
                <div class="icon">
                    <img src="assets/img/icon/footer-4.png" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title">Customer Service</h4>
                    <span>Top notch customer service</span>
                </div>
            </div>
        </div>
        <div class="row footer-widget-wrap pb-60">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">About Store</h3>
                    </div>
                    <div class="footer-contact">
                        <div class="icon"><i class="fa-sharp fa-solid fa-phone-rotary"></i></div>
                        <div class="content">
                            <span>Have Question? Call Us 24/7</span>
                            <a href="tel:{{$infoArray['contact_mobile']}}">{{$infoArray['contact_mobile']}}</a>
                        </div>
                    </div>
                    <ul class="schedule-list">
                        <li><span>Monday - Friday:</span>8:00am - 6:00pm</li>
                        <li><span>Saturday:</span>8:00am - 6:00pm</li>
                        <li><span>Sunday</span> Service Close</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Our Stores</h3>
                    </div>
                    <ul class="footer-list">
                        <li><a href="contact.html">New York</a></li>
                        <li><a href="contact.html">London SF</a></li>
                        <li><a href="contact.html">Los Angele</a></li>
                        <li><a href="contact.html">Chicago</a></li>
                        <li><a href="contact.html">Las Vegas</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Shop Categories</h3>
                    </div>
                    <ul class="footer-list">
                        <li><a href="shop-grid.html">New Arrivals</a></li>
                        <li><a href="shop-grid.html">Best Selling</a></li>
                        <li><a href="shop-grid.html">Vegetables</a></li>
                        <li><a href="shop-grid.html">Fresh Meat</a></li>
                        <li><a href="shop-grid.html">Fresh Seafood</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Useful Links</h3>
                    </div>
                    <ul class="footer-list">
                        <li><a href="contact.html">Privacy Policy</a></li>
                        <li><a href="contact.html">Terms & Conditions</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="blog-grid.html">Latest News</a></li>
                        <li><a href="contact.html">Our Sitemaps</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Our Newsletter</h3>
                    </div>
                    <div class="news-form-wrap">
                        <p class="mb-20">Subscribe to the mailing list to receive updates one the new arrivals and other discounts</p>
                        <div class="footer-form mb-20">
                            <form action="#" class="rr-subscribe-form">
                                <input class="form-control" type="email" name="email" placeholder="Email address">
                                <input type="hidden" name="action" value="mailchimpsubscribe">
                                <button class="submit">Subscribe</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <p class="mb-0">I would like to receive news and special offer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row copyright-content">
                <div class="col-lg-6">
                    <div class="footer-img-wrap">
                        <span>Payment System:</span>
                        <div class="footer-img"><a href="#"><img src="assets/img/images/footer-img-1.png" alt="img"></a></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p>Copyright 2024 <span>©{{$infoArray['website_name']}}</span>. All Right Reserved</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ./ footer-section -->
