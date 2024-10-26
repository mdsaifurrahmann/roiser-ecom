@extends('layouts.client')

@section('title', 'Home')

@section('body')

    @include('client.sections.hero-v2')
    @include('client.sections.category', [$categorySlider])
    @include('client.sections.product-slider')

    @include('client.sections.discount')
    @include('client.sections.cta')
    @include('client.sections.product-grid', ['bg' => 'bg-grey', 'title' => 'Popular Products'])
    @include('client.sections.product-grid', ['bg' => 'bg-white', 'title' => 'Flash Sale'])
    @include('client.sections.product-cta')

@endsection
