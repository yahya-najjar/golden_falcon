<!-- Footer Type-1 -->
<footer class="footer footer-type-1 bg-white">
    <div class="container">
        <div class="footer-widgets top-bottom-dividers pb-mdm-20">
            <div class="row">

                <div class="col-md-2 col-sm-4 col-xs-4 col-xxs-12">
                    <div class="widget footer-links">
                        <h5 class="widget-title uppercase">@lang('footer.info')</h5>
                        <ul class="list-no-dividers">
                            <li><a href="#">@lang('footer.about_link')</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget footer-get-in-touch">
                        <h5 class="widget-title uppercase">@lang('footer.contact_info_title')</h5>
                        <p><i class="fa fa-whatsapp"></i>
                            <a href="tel:{{ $settings->phone ?? '+963 999 999 999' }}">{{ $settings->phone ?? '+963 999 999 999' }}</a>
                        </p>
                        <p><i class="fa fa-envelope-o"></i>
                            <a href="mailto:themesupport@gmail.com">{{ $settings->email ?? 'default@example.com' }}</a>
                        </p>
                        <address class="footer-address">
                            <span><i class="fa fa-map-marker"></i> </span> {{ $settings->address ?? 'default address loaded PO.Box: qw' }}
                        </address>
                        <div class="social-icons rounded mt-20">
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
                    </div>
                </div> <!-- end stay in touch -->

                <div class="col-md-2 col-sm-4 col-xs-4 col-xxs-12">
                    <div class="widget footer-links">
                        <h5 class="widget-title uppercase">@lang('footer.help')</h5>
                        <ul class="list-no-dividers">
                            <li><a href="/#contact-section">@lang('footer.contact_link')</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h5 class="widget-title uppercase">@lang('footer.about_brief_title')</h5>
                        <p class="mb-0">
                            @lang('footer.about_brief_content')
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end container -->

    <div class="bottom-footer bg-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 copyright sm-text-center">
              <span>
                Copyright &copy; Made by <a href="#">SwearKhaddaj</a>
              </span>
                </div>

                <div class="col-sm-4 text-center">
                    <div id="back-to-top">
                        <a href="#top">
                            <i class="fa fa-angle-up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end bottom footer -->
</footer> <!-- end footer -->