<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="{{ $infoArray['og__desc'] }}">
    <meta name="keywords"
          content="@foreach ($keywordsArray as $index => $keyword){{ $keyword }}{{ $index < count($keywordsArray) - 1 ? ', ' : '' }} @endforeach">
    <meta name="author" content="Codebumble Inc.">
    <meta property="og:type" content="{{ $infoArray['og__type'] }}">
    <meta property="og:title"
          content="@yield('title') - {{ $infoArray['website_name'] . ($infoArray['website_slug'] ? ' - ' . $infoArray['website_slug'] :
          null) }}">
    <meta property="og:site_name" content="Donation Site">
    <meta property="og:url" content="{{ $infoArray['url'] }}">
    <meta property="og:image" content="{{ asset('storage/site__info/' . $infoArray['og__image']) }}">
    <meta property="og:description" content="{{ $infoArray['og__desc'] }}">
    <meta name="twitter:title"
          content="@yield('title') - {{ $infoArray['website_name'] . ($infoArray['website_slug'] ? ' - ' . $infoArray['website_slug'] :
          null) }}">
    <meta name="twitter:description" content="{{ $infoArray['og__desc'] }}">
    <meta name="twitter:image" content="{{ asset('storage/site__info/' . $infoArray['og__image']) }}">
    <meta name="twitter:card" content="summary">

    <!-- Site Title -->
    <title>@yield('title') - {{ $infoArray['website_name']}} </title>

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/site__info/' . $infoArray['favicon']) }}">

    @include('layouts._partials.client.style')

    <link rel="stylesheet" href="{{ Vite::asset('resources/assets/scss/main.scss') }}">

    @if (isset($infoArray['inject_head']))
        {!! $infoArray['inject_head'] !!}
    @endif

</head>

    <body>
        @include('layouts._partials.client.preloader')
        @include('client.sections.header')

        @yield('body')


        @include('client.sections.footer')

        <div id="scroll-percentage" style="--rr-color-theme-primary: #67B02E"><span id="scroll-percentage-value"></span></div>
        <!--scrollup-->

        {{--    @include('client.sections.popup-search')--}}
    </body>

    @include('layouts._partials.client.scripts')
    <script src="{{Vite::asset('resources/assets/js/ajax-form.js')}}"></script>
    <script src="{{Vite::asset('resources/assets/js/contact.js')}}"></script>
    <script src="{{Vite::asset('resources/assets/js/main.js')}}"></script>

@if (isset($infoArray['inject_bottom']))
    {!! $infoArray['inject_bottom'] !!}
@endif

</html>
