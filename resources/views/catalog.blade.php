@extends('layouts.app')

@section('title')
    @lang('catalog.title')
@endsection

@section('style')
    <style>
        .hero-lines {
            margin-bottom: 34px;
            opacity: 0.5;
        }
    </style>
@endsection

@section('bread')
    @if(isset($category))
        <li>
            <a href="/catalog">@lang('nav.catalog')</a>
        </li>
        <li class="active">
            {{ $category->title }}
        </li>
    @else
        <li class="active">
            @lang('nav.catalog')
        </li>
    @endif
@endsection

@section('content')
    <!-- Catalogue -->
    <section class="section-wrap pt-70 pb-40 catalogue">
        <div class="container relative">
            <div class="row">

                <div class="col-md-9 catalogue-col {{ app()->getLocale() == 'ar' ? 'right' : 'left' }} mb-50">

                    <!-- Banner -->
                    <div class="banner-wrap relative">
                        <img src="{{ isset($category) ? action('ImageController@show', $category->image)."?w=1140&h=536&fit=crop" : (isset($settings->defaultCatalogImage ) ? action('ImageController@show', $settings->defaultCatalogImage)."?w=1140&h=536&fit=crop" : asset('frontend/img/banner.jpg')) }}"
                             alt="">

                    </div>

                    <div class="shop-filter">
                        @if($results->count() != $results->total())
                            <p class="result-count">@lang('catalog.showing') {{ $results->firstItem() }}
                                - {{ $results->lastItem() }}
                                of {{ $results->total() }} results</p>
                        @endif

                        {{--<form class="ecommerce-ordering">--}}
                        {{--<select>--}}
                        {{--<option value="default-sorting">Default Sorting</option>--}}
                        {{--<option value="price-low-to-high">Price: high to low</option>--}}
                        {{--<option value="price-high-to-low">Price: low to high</option>--}}
                        {{--<option value="by-popularity">By Popularity</option>--}}
                        {{--<option value="date">By Newness</option>--}}
                        {{--<option value="rating">By Rating</option>--}}
                        {{--</select>--}}
                        {{--</form>--}}
                    </div>

                    <div class="shop-catalogue grid-view right">

                        <div class="row row-10 items-grid">
                            @if(count($results))
                                @foreach($results as $result)
                                    <div class="col-md-{{ count($results)  >= 3 ? '4' : (count($results) == 2 ? '6' : '12')  }} col-xs-{{ count($results) == 1 ? '12' : '6' }}">
                                        @include('product-item', ['item' => $result])
                                    </div>

                                @endforeach
                            @else
                                <div class="col-md-12 col-xs-12">
                                    <h1 class="text-muted">@lang('catalog.noProducts')</h1>
                                </div>
                            @endif

                        </div> <!-- end row -->
                    </div> <!-- end grid mode -->

                    <div class="clear"></div>

                    <!-- Pagination -->
                    <div class="pagination-wrap">
                        @if($results->count() != $results->total())
                            <p class="result-count">@lang('catalog.showing') {{ $results->firstItem() }}
                                - {{ $results->lastItem() }}
                                @lang('catalog.of') {{ $results->total() }} @lang('catalog.results')</p>

                            <nav class="pagination right clear">
                                @if($results->previousPageUrl())
                                    <a href="{{ $results->previousPageUrl() }}"><i class="fa fa-angle-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}"></i></a>
                                @else
                                    <span class="page-numbers current"><i class="fa fa-angle-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}"></i></span>
                                @endif
                                @for($i=1; $i<=$results->total() / $results->perPage(); $i++)
                                    @if($results->currentPage() == $i)
                                        <span class="page-numbers current">{{ $i }}</span>
                                    @else
                                        <a href="{{ $results->url($i) }}">{{ $i }}</a>
                                    @endif
                                @endfor
                                @if($results->nextPageUrl())
                                    <a href="{{ $results->nextPageUrl() }}"><i class="fa fa-angle-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}"></i></a>
                                @else
                                    <span class="page-numbers current"><i class="fa fa-angle-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}"></i></span>
                                @endif
                            </nav>
                        @endif
                    </div>

                </div> <!-- end col -->

                <!-- Sidebar -->
                <aside class="col-md-3 sidebar left-sidebar" style="{{ app()->getLocale() == 'ar' ? 'float:right' : '' }}">

                    <!-- Categories -->
                    <div class="widget categories">
                        <h3 class="widget-title uppercase">@lang('catalog.categories')</h3>
                        <ul class="list-no-dividers">
                            @foreach($categories as $catSide)
                                <li>
                                    <a href="/catalog?category={{ $catSide->id }}" {{ $catSide->id == request()->category ? 'style=color:black' : '' }}>
                                        {{ $catSide->title }}
                                    </a>
                                    <ul class="list-no-dividers"
                                        style="margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 1em">
                                        @foreach($catSide->children()->whereType(\App\Models\Item::Category)->active()->get() as $catSideL1)
                                            <li>
                                                <a href="/catalog?category={{ $catSideL1->id }}" {{ $catSideL1->id == request()->category ? 'style=color:black' : '' }}>
                                                    {{ $catSideL1->title }}
                                                </a>
                                                <ul class="list-no-dividers"
                                                    style="margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 2em">
                                                    @foreach($catSideL1->children()->whereType(\App\Models\Item::Category)->active()->get() as $catSideL2)
                                                        <li>
                                                            <a href="/catalog?category={{ $catSideL2->id }}" {{ $catSideL2->id == request()->category ? 'style=color:black' : '' }}>
                                                                {{ $catSideL2->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>

                                </li>
                            @endforeach
                        </ul>
                    </div>

                </aside> <!-- end sidebar -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section> <!-- end catalogue -->

@endsection