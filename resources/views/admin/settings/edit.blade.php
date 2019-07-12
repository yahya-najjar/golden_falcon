@extends('admin.layouts.app')
@section('title')
    الإعدادات
@endsection

@section('bread')
    <li class="breadcrumb-item active">الإعدادات</li>
@endsection

@section('style')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px; /* The height is 400 pixels */
            width: 100%; /* The width is the width of the web page */
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }
    </style>
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.settings.store') }}" method="post" enctype="multipart/form-data"
                          class="form-material">

                        {{ csrf_field() }}

                        <div class="form-body">

                            <h3 class="card-title">إدارة إعدادات الموقع</h3>

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#basics"
                                                        role="tab"><span class="hidden-sm-up"><i
                                                    class="ti-home"></i></span> <span
                                                class="hidden-xs-down">أساسيات</span></a>
                                </li>

                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#social"
                                                        role="tab"><span class="hidden-sm-up"><i
                                                    class="ti-user"></i></span> <span class="hidden-xs-down">صفحات التواصل الاجتماعي</span></a>
                                </li>

                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact"
                                                        role="tab"><span class="hidden-sm-up"><i
                                                    class="ti-user"></i></span> <span
                                                class="hidden-xs-down">اتصل بنا</span></a>
                                </li>

                            </ul>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="basics" role="tabpanel">
                                    <div class="row p-t-20">

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('favicon') ? 'has-danger' : '' }}">
                                                <label class="control-label">الصورة المصغرة</label>
                                                <input type="file" name="favicon" class="form-control">

                                                @if ($errors->has('favicon'))
                                                    <small class="form-control-feedback">{{ $errors->first('favicon') }}</small>
                                                @endif

                                                @if(isset($settings->favicon) && $settings->favicon != "")
                                                    <div class="col-md-12" style="margin: 10px">
                                                        <div class="row el-element-overlay">
                                                            <div class="el-card-item">
                                                                <div class="el-card-avatar el-overlay-1"><img
                                                                            src="{{ action('ImageController@show', $settings->favicon) }}"
                                                                            alt="Main Page"
                                                                            style="background-color: black; max-width: 150px">
                                                                    <div class="el-overlay">
                                                                        <ul class="el-info">
                                                                            <li>
                                                                                <a class="btn default btn-outline image-popup-vertical-fit"
                                                                                   href="{{ action('ImageController@show', $settings->favicon) }}"
                                                                                   target="_blank"><i
                                                                                            class="icon-magnifier"></i></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('logo') ? 'has-danger' : '' }}">
                                                <label class="control-label">اللوغو</label>
                                                <input type="file" name="logo" class="form-control">
                                                @if ($errors->has('logo'))
                                                    <small class="form-control-feedback">{{ $errors->first('logo') }}</small>
                                                @endif

                                                @if(isset($settings->logo) && $settings->logo != "")
                                                    <div class="col-md-12" style="margin: 10px">
                                                        <div class="row el-element-overlay">
                                                            <div class="el-card-item">
                                                                <div class="el-card-avatar el-overlay-1"><img
                                                                            src="{{ asset('storage/' . $settings->logo) }}"
                                                                            alt="Main Page"
                                                                            style="background-color: black; max-width: 150px"/>
                                                                    <div class="el-overlay">
                                                                        <ul class="el-info">
                                                                            <li>
                                                                                <a class="btn default btn-outline image-popup-vertical-fit"
                                                                                   href="{{ asset('storage/' . $settings->logo) }}"
                                                                                   target="_blank"><i
                                                                                            class="icon-magnifier"></i></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('videoThumb') ? 'has-danger' : '' }}">
                                                <label class="control-label">صورة الفيديو الدعائي (1280W X 720H)</label>
                                                <input type="file" name="videoThumb" class="form-control">
                                                @if ($errors->has('videoThumb'))
                                                    <small class="form-control-feedback">{{ $errors->first('videoThumb') }}</small>
                                                @endif

                                                @if(isset($settings->videoThumb) && $settings->videoThumb != "")
                                                    <div class="col-md-12" style="margin: 10px">
                                                        <div class="row el-element-overlay">
                                                            <div class="el-card-item">
                                                                <div class="el-card-avatar el-overlay-1"><img
                                                                            src="{{ action('ImageController@show', $settings->videoThumb) }}"
                                                                            alt="Main Page"
                                                                            style="background-color: black; max-width: 300px"/>
                                                                    <div class="el-overlay">
                                                                        <ul class="el-info">
                                                                            <li>
                                                                                <a class="btn default btn-outline image-popup-vertical-fit"
                                                                                   href="{{ action('ImageController@show', $settings->videoThumb) }}"
                                                                                   target="_blank"><i
                                                                                            class="icon-magnifier"></i></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('video') ? 'has-danger' : '' }}">
                                                <label class="control-label">الفيديو الدعائي</label>
                                                <input type="file" name="video"
                                                       class="form-control">
                                                @if ($errors->has('video'))
                                                    <small class="form-control-feedback">{{ $errors->first('video') }}</small>
                                                @endif

                                                @if(isset($settings->video) && $settings->video != "")

                                                    <video width="300px" src="{{ url('/storage/' . $settings->video) }}"
                                                           frameborder="0" controls></video>

                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="social" role="tabpanel">
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('facebook') ? 'has-danger' : '' }}">
                                                <label class="control-label">Facebook</label>
                                                <input type="text" name="facebook" class="form-control"
                                                       value="{{ $settings->facebook ?? '' }}">
                                                @if ($errors->has('facebook'))
                                                    <small class="form-control-feedback">{{ $errors->first('facebook') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('linkedin') ? 'has-danger' : '' }}">
                                                <label class="control-label">Linked In</label>
                                                <input type="text" name="linkedin" class="form-control"
                                                       value="{{ $settings->linkedin ?? '' }}">
                                                @if ($errors->has('linkedin'))
                                                    <small class="form-control-feedback">{{ $errors->first('linkedin') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('instagram') ? 'has-danger' : '' }}">
                                                <label class="control-label">Instagram</label>
                                                <input type="text" name="instagram" class="form-control"
                                                       value="{{ $settings->instagram ?? '' }}">
                                                @if ($errors->has('instagram'))
                                                    <small class="form-control-feedback">{{ $errors->first('instagram') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="contact" role="tabpanel">
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('mobile') ? 'has-danger' : '' }}">
                                                <label class="control-label">رقم الموبايل</label>
                                                <input type="text" name="mobile" class="form-control"
                                                       value="{{ $settings->mobile ?? '' }}">
                                                @if ($errors->has('mobile'))
                                                    <small class="form-control-feedback">{{ $errors->first('mobile') }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('landline') ? 'has-danger' : '' }}">
                                                <label class="control-label">رقم الأرضي</label>
                                                <input type="text" name="landline" class="form-control"
                                                       value="{{ $settings->landline ?? '' }}">
                                                @if ($errors->has('landline'))
                                                    <small class="form-control-feedback">{{ $errors->first('landline') }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('location') ? 'has-danger' : '' }}">
                                                <label class="control-label">الموقع</label>
                                                <input type="text" name="location" class="form-control"
                                                       value="{{ $settings->location ?? 'ساحة الأمويين' }}">
                                                @if ($errors->has('location'))
                                                    <small class="form-control-feedback">{{ $errors->first('location') }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <input type="text" class="form-control form-control-line"
                                               name="long"
                                               placeholder="احداثيات خط الطول"
                                               value="{{ isset($settings) ? $settings->long ?? old('long') ?? '36.2765' : '36.2765' }}"
                                               style="display: none"/>

                                        <input type="text" class="form-control form-control-line"
                                               name="lat"
                                               placeholder="احداثيات خط العرض"
                                               value="{{ isset($settings) ? $settings->lat ?? old('lat') ?? '33.5138' : '33.5138' }}"
                                               style="display: none"/>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pac-input" class="text-muted">يمكنك تعليم الموقع على الخريطة
                                                    أو البحث عنه في مربع البحث</label>
                                                <input id="pac-input" class="controls" type="text"
                                                       placeholder="Search Box">
                                                <div id="map"></div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <!--/span-->
                            <!--/row-->
                            <div class="form-actions">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> حفظ
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var lat = parseFloat($("input[name='lat']").val());
        var lng = parseFloat($("input[name='long']").val());

        function initMap() {
            // The location of Uluru
            var uluru = {lat: lat, lng: lng};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 17, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});

            var geocoder = new google.maps.Geocoder;
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
                geocoder.geocode({'location': event.latLng}, function (results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            // map.setZoom(17);
                            $("input[name='location']").val(results[0].formatted_address)
                        } else {
                            $("input[name='location']").val("No Address Found!")
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            });

            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    // var icon = {
                    //     url: place.icon,
                    //     size: new google.maps.Size(71, 71),
                    //     origin: new google.maps.Point(0, 0),
                    //     anchor: new google.maps.Point(17, 34),
                    //     scaledSize: new google.maps.Size(25, 25)
                    // };

                    // // Create a marker for each place.
                    // markers.push(new google.maps.Marker({
                    //     map: map,
                    //     icon: icon,
                    //     title: place.name,
                    //     position: place.geometry.location
                    // }));

                    $("input[name='lat']").val(place.geometry.location.lat);
                    $("input[name='long']").val(place.geometry.location.lng);
                    $("input[name='location']").val(place.formatted_address);

                    marker.setPosition(place.geometry.location);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });

            function placeMarker(location) {
                marker.setPosition(location);
                $("input[name='lat']").val(marker.getPosition().lat());
                $("input[name='long']").val(marker.getPosition().lng());
            }
        }

        $(document).keypress(function (e) {
            if (e.which == 13) {
                e.preventDefault();   //<---- Add this line
            }
        });
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDX2YTXGETKmbutCt94wZaiZcGp_Jif_C0&callback=initMap&libraries=places">
    </script>
@endsection