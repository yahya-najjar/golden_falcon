@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/404.css') }}">
@endsection

@section('title')
    404
@endsection

@section('content')
    <!-- 404 -->
    <section class="section-wrap page-404">
        <div class="container">

            <div class="row text-center">
                <div class="col-md-6 col-md-offset-3">
                    <h1>404</h1>
                    <h2 class="mb-50">@lang('404.title')</h2>
                    <p class="mb-20">@lang('404.beforeLink') <a href="/">@lang('404.link')</a> @lang('404.afterLink')</p>
                    <form class="relative" action="{{ action('SiteController@search') }}">
                        <input name="q" type="search" placeholder="@lang('404.search')" class="mb-0">
                        <button type="submit" class="search-button"
                                style="{{ app()->getLocale() == 'ar' ? 'left:10px !important' : '' }}">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section> <!-- end 404 -->
@endsection