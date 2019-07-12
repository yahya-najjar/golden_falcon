<!-- Google Map -->
<div id="contact-section" class="container mt-60">
    <div id="map" class="gmap"></div>
</div>

<!-- Contact -->
<section class="section-wrap contact">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <h5 class="uppercase mb-30">@lang('welcomePage.sendUsMessage')</h5>
                <form id="contact-form" action="#">

                    <div class="contact-name">
                        <input name="name" id="name" type="text" placeholder="@lang('welcomePage.Name')*">
                    </div>
                    <div class="contact-email">
                        <input name="mail" id="mail" type="email" placeholder="@lang('welcomePage.E-mail')*">
                    </div>
                    <div class="contact-subject">
                        <input name="subject" id="subject" type="text" placeholder="@lang('welcomePage.Subject')">
                    </div>

                    <textarea name="comment" id="comment" placeholder="@lang('welcomePage.Message')" rows="9"></textarea>
                    <input type="submit" class="btn btn-lg btn-color btn-submit" value="@lang('welcomePage.Submit')" id="submit-message">
                    <div id="msg" class="message"></div>
                </form>
            </div> <!-- end col -->

            <div class="col-md-4 mb-40 mt-mdm-40 contact-info">

                {{--<div class="address-wrap">--}}
                    {{--<h4 class="uppercase">Address</h4>--}}
                    {{--<h6>Philippines Store</h6>--}}
                    {{--<address class="address">Philippines, PO Box 620067, Talay st. 66, A-ha inc.</address>--}}
                    {{--<h6>Canada Store</h6>--}}
                    {{--<address class="address">A-ha inc, 10-123 Main st. NW, Montreal QC, H3Z2Y7</address>--}}
                {{--</div>--}}

                <h4 class="uppercase">@lang('welcomePage.contactInfo')</h4>
                <ul class="contact-info-list">
                    <li><span><i class="fa fa-whatsapp"></i> </span>
                        <a href="tel:{{ $settings->phone ?? '+963 999 999 999' }}">{{ $settings->phone ?? '+963 999 999 999' }}</a>
                    </li>
                    <li><span><i class="fa fa-envelope-o"></i> </span>
                        <a href="mailto:themesupport@gmail.com">{{ $settings->email ?? 'default@example.com' }}</a>
                    </li>
                    <li><span><i class="fa fa-map-marker"></i> </span>
                        <a href="#">{{ $settings->address ?? 'default address loaded PO.Box: qw' }}</a>
                    </li>
                </ul>
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

        </div>
    </div>
</section> <!-- end contact -->