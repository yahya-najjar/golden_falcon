<!DOCTYPE html>
<html lang="en">

<head>
    <title>@lang('meta.title') | @yield('title')</title>

    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">

    <style>
        @font-face {
            font-family: Niramit;
            src: url({{ asset('assets/fonts/Niramit-Regular.ttf') }});

        }

        @font-face {
            font-family: Tajawal;
            src: url({{ asset('assets/fonts/Tajawal-Medium.ttf') }});

        }

    </style>
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-rtl.min.css') }}">

        <style>
            h1, h2, h3, h4, h5, h6, p, div, strong, span, body {
                font-family: Niramit, Tajawal, serif !important;
            }
        </style>
    @else
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"/>
    @endif

<!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,700%7CRaleway:300,400,700%7CPlayfair+Display:700'
          rel='stylesheet'>

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/font-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/sliders.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}"/>

    <!-- Favicons -->
    <link rel="shortcut icon"
          href="{{ isset($settings->favicon) ? action('ImageController@show', $settings->favicon) : asset('frontend/img/apple-touch-icon-72x72.png') }}">
    {{--<link rel="apple-touch-icon" href="{{ asset('frontend/img/apple-touch-icon.html') }}">--}}
    <link rel="apple-touch-icon" sizes="72x72"
          href="{{ isset($settings->favicon) ? action('ImageController@show', $settings->favicon) : asset('frontend/img/apple-touch-icon-72x72.png') }}">

    <style>
        .dot {
            height: 15px;
            width: 15px;
            /*background-color: #bbb;*/
            border-radius: 50%;
            display: inline-block;
        }
    </style>

    <style>
        .product-details > h3, .product-list-widget a > span, .table.shop_table tr td.product-name a {
            margin-bottom: 10px;
        }

        .navigation.sticky {
            height: auto;
        }

        @media (max-width: 991px) {
            #mobile-search .search-button {
                width: auto;
            }

            .megamenu-item {
                border-bottom: 1px solid #ebebeb;
                margin-top: 1em;
            }

            .navbar-header {
                height: 87.3px !important;
            }
        }

        @if(app()->getLocale() == 'ar')
            @media (max-width: 991px) {
            .navbar-nav > li > a {
                text-align: right;
            }
        }
        @endif

    </style>

    <style>
        .header-wrap-holder {
            border-bottom: none;
            display: block;
        }

        .navbar-nav > li > a {
            font-size: 16px;
        }
    </style>


    @yield('style')

</head>

<body class="relative">

<!-- Preloader -->
<div class="loader-mask">
    <div class="loader">
        <div></div>
        <div></div>
    </div>
</div>

<main class="content-wrapper oh">

    <!-- Navigation -->
    <header class="nav-type-1">

        @include('layouts.top-bar')
        @include('layouts.nav')

    </header> <!-- end navigation -->

@if(!isset($homePage))
    <!-- Breadcrumbs -->
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="/">@lang('nav.home')</a>
                </li>
                @yield('bread')
            </ol> <!-- end breadcrumbs -->
        </div>
    @endif

    @yield('content')

    @include('layouts.footer')

</main> <!-- end main container -->

<!-- jQuery Scripts -->
<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>

@if(app()->getLocale() == 'ar')
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-rtl.min.js') }}"></script>
    <script>
        $('html').attr('dir', 'rtl');
        $('div').addClass('rtl');
    </script>
@else
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
@endif

<script type="text/javascript" src="{{ asset('frontend/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/scripts.js') }}"></script>

@yield('script')

</body>
</html>