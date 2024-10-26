@extends('layouts.client')

@section('title', 'About')

@section('body')

    <section class="about-section pt-100 pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-content">
                        <div class="section-heading">
                            <h2 class="section-title">Creating a World Where Fashion is a Lifestyle</h2>
                            <p>Fashionable content invites us to embark on a fashion-forward journey, where creativity knows no bounds and self-expression is celebrated. So, let's dive into the world of fashion, where trends are set, boundaries are broken.</p>
                        </div>
                        <div class="about-items">
                            <div class="about-item"><i class="fa-sharp fa-solid fa-circle-check"></i>Fast Growing Sells</div>
                            <div class="about-item"><i class="fa-sharp fa-solid fa-circle-check"></i>24/7 Quality Services</div>
                            <div class="about-item"><i class="fa-sharp fa-solid fa-circle-check"></i>Skilled Team Members</div>
                            <div class="about-item"><i class="fa-sharp fa-solid fa-circle-check"></i>Best Quality Services</div>
                        </div>
                        <a href="#" class="rr-primary-btn about-btn">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about-img">
                        <img src="assets/img/images/about-img-1.jpg" alt="about">
                        <div class="play-btn">
                            <a
                                class="video-popup"
                                data-autoplay="true"
                                data-vbtype="video"
                                href="https://youtu.be/Dngwk0BBLmw?feature=shared">
                                <div class="play-btn">
                                    <i class="fa-sharp fa-solid fa-play"></i>
                                </div>
                                <div class="ripple"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ about-section -->

@endsection
