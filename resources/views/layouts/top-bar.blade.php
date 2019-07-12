<div class="top-bar">
    <div class="container">
        <div class="top-bar-line">
            <div class="row">
                <div class="top-bar-links ">
                    <ul class="col-sm-6 top-bar-acc hidden-sm hidden-xs">
                        {{--<li class="top-bar-link"><a href="#">My Account</a></li>--}}
                        {{--<li class="top-bar-link"><a href="#">My Wishlist</a></li>--}}
                        {{--<li class="top-bar-link"><a href="#">Newsletter</a></li>--}}
                        <li class="top-bar-link"><a href="/admin">@lang('topbar.login')</a></li>
                        <li class="top-bar-link"><a href="/#contact-section">@lang('topbar.contact')</a></li>
                    </ul>

                    <ul class="col-sm-6 text-right top-bar-currency-language">
                        <li class="language">
                            @lang('topbar.language') <a href="#">{{ strtoupper(app()->getLocale()) }}<i
                                        class="fa fa-angle-down"></i></a>
                            <div class="language-dropdown">
                                <ul>
                                    @foreach(\Localization::getSupportedLocales() as $key => $locale)
                                        <li><a href="/lang/{{ $key }}">{{ $locale->native() }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="social-icons">
                                @if(isset($settings->instagram))
                                    <a href="{{ $settings->instagram }}"><i class="fa fa-instagram"></i></a>
                                @endif
                                @if(isset($settings->facebook))
                                    <a href="{{ $settings->facebook }}"><i class="fa fa-facebook"></i></a>
                                @endif
                                @if(isset($settings->linkedin))
                                    <a href="{{ $settings->linkedin }}"><i class="fa fa-linkedin"></i></a>
                                @endif

                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </div>
</div> <!-- end top bar -->
