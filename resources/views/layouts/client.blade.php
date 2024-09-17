<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <!-- Site Title -->
    <title>Roiser – Multipurpose eCommerce HTML5 Template</title>

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("assets/img/favicon.png")}}">

    @include('layouts._partials.client.style')

    <link rel="stylesheet" href="{{ Vite::asset('resources/assets/scss/main.scss') }}">
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

</html>
