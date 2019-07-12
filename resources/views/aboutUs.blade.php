@extends('layouts.app')

@section('title')
    @lang('aboutPage.title')
@endsection

@section('bread')
    <li class="active">
        @lang('nav.about')
    </li>
@endsection

@section('content')
    <!-- About us -->
    <section class="section-wrap about-us pb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <img src="{{ action('ImageController@show', $about->image) }}?w=1140&h=410?fit=crop" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="about-intro uppercase">{{ $about->title }}</h4>
                    {!! $about->content !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="container">
        <hr>
    </div>

    <!-- Google Map -->
    <div class="container mt-60">
        <div id="map" class="gmap"></div>
    </div>
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

@endsection