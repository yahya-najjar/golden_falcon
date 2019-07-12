@extends('layouts.app', ['homePage' => 1])

@section('title')
    @lang('welcomePage.title')
@endsection

@section('style')
    <style>
        @foreach($slides as $slide)
            .img-{{$slide->id}}
                                  {
            {{--@if(strpos('gif', $slide->image))--}}
                background-image: url({{ url('/storage/' . $slide->image) }});
            {{--@else--}}
                {{--background-image: url({{action('ImageController@show', $slide->image)}}?h=536&w=1140&fit=crop);--}}
            {{--@endif--}}
}

        @endforeach

        #map {
            height: 400px; /* The height is 400 pixels */
            width: 100%; /* The width is the width of the web page */
        }

        .video-section-parent {
            background-image: url("{{ isset($settings->videoThumb) ? action('ImageController@show', $settings->videoThumb) : 'http://www.seewantshop.com.au/wp-content/uploads/2012/09/featureimage_JoshGoot2012Floral.jpg' }}");
            height: 400px;
            opacity: 0.8;
            /*background-color: rgba(220,220,220,0.6);*/
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/css/modal.css') }}">
@endsection

@section('content')
    <!-- Hero Slider -->
    <section class="section-wrap nopadding hidden-xs">
        <div class="container">
            <div class="entry-slider">
                <div class="flexslider" id="flexslider-hero">
                    <ul class="slides clearfix">
                        @foreach($slides as $slide)
                            @if(strpos('gif', $slide->image))
                                <li style="height: 536px; object-fit: cover">
                                    <img src="{{ action('ImageController@show', $slide->image) }}?h=536&w=1140&fit=crop"
                                         alt="">
                                    <div class="img-holder img-{{ $slide->id }}"></div>
                                </li>
                            @else
                                <li style="height: 536px; object-fit: cover">
                                    <img src="{{ url('/storage/' . $slide->image) }}"
                                         alt="">
                                    <div class="img-holder img-{{ $slide->id }}"></div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div> <!-- end slider -->
        </div>
    </section> <!-- end hero slider -->


    <!-- New Arrivals -->
    @if(count($categories))
        <section class="section-wrap new-arrivals pb-40">
            <div class="container">

                <div class="row heading-row">
                    <div class="col-md-12 text-center">
                        <h2 class="heading uppercase">
                            <small>@lang('welcomePage.featured_categories')</small>
                        </h2>
                    </div>
                </div>

                <div class="row row-10">
                    @foreach($categories as $category)
                        <div class="col-md-4 col-xs-6 animated-from-left">
                            @include('category-item', ['item' => $category])
                        </div>
                    @endforeach
                </div> <!-- end row -->
            </div>
        </section> <!-- end new arrivals -->
    @endif

    @if(count($featuredProducts))
        <section class="section-wrap new-arrivals pb-40">
            <div class="container">

                <div class="row heading-row">
                    <div class="col-md-12 text-center">
                        <h2 class="heading uppercase">
                            <small>@lang('welcomePage.featured_products')</small>
                        </h2>
                    </div>
                </div>

                <div class="row row-10">
                    @foreach($featuredProducts as $featuredProduct)
                        <div class="col-md-3 col-xs-6 animated-from-left">
                            @include('product-item', ['item' => $featuredProduct])
                        </div>
                    @endforeach
                </div> <!-- end row -->
            </div>
        </section> <!-- end new arrivals -->
    @endif

    @if(isset($settings->video) and isset($settings->videoThumb))
        <section class="section-wrap video-section-parent">
            <div data-toggle="modal" data-target="#myModal" class="video-section">
                {{--<img id="video-image" class="img-responsive" src="http://www.seewantshop.com.au/wp-content/uploads/2012/09/featureimage_JoshGoot2012Floral.jpg" alt="">--}}
            </div>
        </section>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="vertical-alignment-helper">
                <div class="modal-dialog vertical-align-center modal-lg" role="document">
                    <div class="modal-content">


                        <div class="modal-content">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <video width="1280" height="720" src="{{ url('/storage/' . $settings->video) }}"
                                       id="video"></video>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endif

    @include('contact')

@endsection

@section('script')
    <script>
        var map;
        var uluru = {
            lat: parseFloat('{{ $settings->lat ?? "33.5138" }}'),
            lng: parseFloat('{{ $settings->long ?? "36.2765" }}')
        };

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: uluru,
                zoom: 14
            });
            var marker = new google.maps.Marker({position: uluru, map: map});
        }

    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDX2YTXGETKmbutCt94wZaiZcGp_Jif_C0&callback=initMap">
    </script>

    <script>

        $(document).ready(function () {
            $('a[href$="/#contact-section"]').attr('href', '#contact-section').addClass('scrollLink')
            $("a.scrollLink").click(function (event) {
                event.preventDefault();
                $("html, body").animate({scrollTop: $($(this).attr("href")).offset().top}, 500);
            });
        });

        let vidoeSource = $('#video').attr('src')

        $('#myModal').on('shown.bs.modal', function (e) {
            document.getElementById("video").play()
        })
        //
        //
        // // stop playing the youtube video when I close the modal
        $('#myModal').on('hide.bs.modal', function (e) {
            // a poor man's stop video
            document.getElementById("video").pause()
        })
    </script>

@endsection