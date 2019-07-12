<nav class="navbar navbar-static-top rtl">
    <div class="navigation" id="sticky-nav">
        <div class="container relative">

            <div class="row">

                <div class="navbar-header rtl">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Mobile cart -->
                    {{--<div class="nav-cart mobile-cart hidden-lg hidden-md">--}}
                    {{--<div class="nav-cart-outer">--}}
                    {{--<div class="nav-cart-inner">--}}
                    {{--<a href="#" class="nav-cart-icon">2</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div> <!-- end navbar-header -->

                <div class="header-wrap">
                    <div class="header-wrap-holder">

                        <!-- Search -->
                        <div class="nav-search hidden-sm hidden-xs">
                            <form method="get" action="{{ action('SiteController@search') }}" >
                                <input name="q" type="search" class="form-control" placeholder="@lang('nav.search')">
                                <button type="submit" class="search-button"
                                        style="{{ app()->getLocale() == 'ar' ? 'left:10px !important' : '' }}">
                                    <i class="icon icon_search"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Logo -->
                        <div class="logo-container">
                            <div class="logo-wrap text-right">
                                <a href="/">
                                    @if(isset($settings->logo))
                                        <img class="logo" src="{{ action('ImageController@show', $settings->logo) }}"
                                             alt="logo">
                                    @else
                                        <img class="logo" width="200px" style="max-height: none"
                                             src="{{ isset($settings->logo) ? action('ImageController@show', $settings->logo) : asset('frontend/img/logo_black.png') }}" alt="logo">
                                    @endif
                                </a>
                            </div>
                        </div>

                    </div>
                </div> <!-- end header wrap -->

                <div class="nav-wrap">
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li id="mobile-search" class="hidden-lg hidden-md">
                                <form action="{{ action('SiteController@search') }}" method="get"
                                      class="mobile-search relative">
                                    <input type="search" name="q" class="form-control"
                                           placeholder="@lang('nav.search')">
                                    <button type="submit" class="search-button" style="{{ app()->getLocale() == 'ar' ? 'left:10px !important' : '' }}">
                                        <i class="icon icon_search" style="{{ app()->getLocale() == 'ar' ? 'left:10px !important' : '' }}"></i>
                                    </button>
                                </form>
                            </li>

                            <li class="dropdown">
                                <a href="/">@lang('nav.home')</a>
                            </li>

                            <li class="dropdown">
                                <a href="/about">@lang('nav.about')</a>
                            </li>

                            @if(count($menuCategories))
                                <li class="dropdown">
                                    <a href="/catalog" class="dropdown-toggle"
                                       data-toggle="dropdown">@lang('nav.catalog')</a>
                                    <ul class="dropdown-menu megamenu"
                                        style="{{ app()->getLocale() == 'ar' ? 'right: -550.172px;' : '' }}">
                                        <li>
                                            <div class="megamenu-wrap">
                                                <div class="row">

                                                    @foreach($menuCategories as $menuCategory)

                                                        <div class="col-md-3 megamenu-item" style="border-right: none;">
                                                            <h6>
                                                                <a href="/catalog?category={{ $menuCategory->id }}">{{ $menuCategory->title }}</a>
                                                            </h6>
                                                            <ul class="menu-list">
                                                                @foreach($menuCategory->children as $child)
                                                                    <li>
                                                                        <a href="/catalog?category={{ $child->id }}">{{ $child->title }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li> <!-- end categories -->
                            @endif

                            <li class="dropdown">
                                <a href="/#contact-section">@lang('nav.contact')</a>
                            </li>

                        </ul> <!-- end menu -->
                    </div> <!-- end collapse -->
                </div> <!-- end col -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </div> <!-- end navigation -->
</nav> <!-- end navbar -->