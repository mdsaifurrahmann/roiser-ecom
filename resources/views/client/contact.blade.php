@extends('layouts.client')

@section('title', 'Contact Us')

@section('body')

    <section class="contact-section pt-60 pb-60">
        <div class="container">
            <h2 class="text-center section-title mb-30">Contact Us</h2>
            <div class="row contact-wrap">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-contact-form form-2">
                        <div class="request-form">
                            <h2 class="form-title">Get in Touch</h2>
                            <form action="mail.php" method="post" id="ajax_contact" class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-header">Your name</h4>
                                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-header">Email address</h4>
                                            <input type="text" id="email" name="email" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-header">Subject</h4>
                                            <input type="text" id="subject" name="subject" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">
                                            <h4 class="form-header">Write Your Message</h4>
                                            <textarea id="message" name="message" cols="30" rows="5" class="form-control address" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button id="submit" class="rr-primary-btn" type="submit">Submit Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="contact-content">
                        <div class="contact-img"><img src="assets/img/images/contact-img.png" alt=""></div>
                        <div class="contact-info-box">
                            <h3 class="title">Clothing Store</h3>
                            <ul>
                                <li>Germany — 785 15h Street, Office 478/B <br> Green Mall Berlin, De 81566</li>
                                <li>Phone: <a href="tel:+1123456788">+1 1234 567 88</a></li>
                                <li>Email: <a href="mailto:contact@example.com">contact@example.com</a></li>
                            </ul>
                        </div>
                        <div class="contact-info-box">
                            <h3 class="title">Opening Hours</h3>
                            <ul>
                                <li>Monday - Friday : 9am - 5pm <br>Weekend Closed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ contact-section -->


@endsection
