@extends('layouts.app')

@section('title')
    {{ $product->title }}
@endsection

@section('bread')
    <li>
        <a href="/catalog">@lang('nav.catalog')</a>
    </li>

    <li>
        <a href="/catalog?category={{ $product->parent->id }}">
            {{ $product->parent->title }}
        </a>
    </li>

    <li class="active">
        {{ $product->title }}
    </li>
@endsection


@section('content')
    <!-- Single Product -->
    <section class="section-wrap single-product">
        <div class="container relative">
            <div class="row">

                <div class="col-sm-6 col-xs-12 mb-60">

                    <div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">

                        <div class="gallery-cell">
                            <a href="{{ action('ImageController@show', $product->image) }}" class="lightbox-img">
                                <img src="{{ action('ImageController@show', $product->image) }}" alt=""/>
                                <i class="icon arrow_expand"></i>
                            </a>
                        </div>

                        @foreach($product->images as $image)
                            <div class="gallery-cell">
                                <a href="{{ action('ImageController@show', $image->path) }}" class="lightbox-img">
                                    <img src="{{ action('ImageController@show', $image->path) }}?w=277&h=347&fit=crop"
                                         alt=""/>
                                    <i class="icon arrow_expand"></i>
                                </a>
                            </div>
                        @endforeach
                    </div> <!-- end gallery main -->

                    <div class="gallery-thumbs">

                        <div class="gallery-cell">
                            <img src="{{ action('ImageController@show', $product->image) }}?w=103&h=129&fit=crop"
                                 alt=""/>
                        </div>
                        @foreach($product->images as $image)
                            <div class="gallery-cell">
                                <img src="{{ action('ImageController@show', $image->path) }}?w=103&h=129&fit=crop"
                                     alt=""/>
                            </div>
                        @endforeach
                    </div> <!-- end gallery thumbs -->

                </div> <!-- end col img slider -->

                <div class="col-sm-6 col-xs-12 product-description-wrap">
                    <h1 class="product-title">{{ $product->title }}</h1>

                    <div class="product_meta">
                        <span class="posted_in"><a
                                    href="/catalog?category={{ $product->parent->id }}">{{ $product->parent->title }}</a></span>
                    </div>

                    <p class="product-description">{{ $product->content }}</p>

                    <div class="select-options">
                        <div class="row row-20">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom: 1em;">
                                        <strong>
                                            @lang('ProductPage.Available_Colors')
                                        </strong>
                                    </div>
                                    <div class="col-md-12">
                                        @foreach($product->colors as $color)
                                            <span class="dot"
                                                  style="background-color: {{ $color }}; height: 30px; width: 30px;"></span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @if(count($product->sizes))
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 1em;">
                                            <strong>
                                                @lang('ProductPage.Available_Sizes')
                                            </strong>
                                        </div>

                                        <div class="col-md-12">
                                            @foreach($product->sizes as $key =>$size)
                                                <span>
                                                    <strong>
                                                        {{ $size . ($key+1 < count($product->sizes) ? ' - ' : '') }}
                                                    </strong>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{--<div class="socials-share clearfix">--}}
                    {{--<div class="social-icons rounded">--}}
                    {{--<a href="#"><i class="fa fa-twitter"></i></a>--}}
                    {{--<a href="#"><i class="fa fa-facebook"></i></a>--}}
                    {{--<a href="#"><i class="fa fa-google-plus"></i></a>--}}
                    {{--<a href="#"><i class="fa fa-linkedin"></i></a>--}}
                    {{--<a href="#"><i class="fa fa-vimeo"></i></a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div> <!-- end col product description -->
            </div> <!-- end row -->

        </div> <!-- end container -->
    </section> <!-- end single product -->


    @if(count($siblings))
        <!-- Related Items -->
        <section class="section-wrap related-products pt-0" dir="ltr">
            <div class="container">
                <div class="row heading-row">
                    <div class="col-md-12 text-center">
                        <h2 class="heading uppercase">
                            <small>@lang('ProductPage.Related_Products')</small>
                        </h2>
                    </div>
                </div>

                <div class="row row-10">

                    <div id="owl-related-products" class="owl-carousel owl-theme nopadding">

                        @foreach($siblings as $sibling)
                            <div class="animated-from-left">
                                @include('product-item', ['item' => $sibling])
                            </div>
                        @endforeach

                    </div> <!-- end owl -->

                </div> <!-- end row -->
            </div> <!-- end container -->
        </section> <!-- end related products -->
    @endif
@endsection