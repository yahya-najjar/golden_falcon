@extends('admin.layouts.app')
@section('title')
    صور المنتج
@endsection

@section('bread')
    <li class="breadcrumb-item"><a href="{{ action('Admin\ItemController@edit', $item) }}">{{ $item->translate('ar')->title }}</a></li>
    <li class="breadcrumb-item active">صور المنتج</li>
@endsection

@section('style')
    <link href="/assets/css/pages/user-card.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{--<h4 class="card-title">Item Images</h4>--}}

                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active" id="form" role="tabpanel">


                            <form class="form-material" enctype="multipart/form-data"
                                  action="{{ action('Admin\ItemController@storeImages', $item) }}"
                                  method="post">
                                {{ csrf_field() }}

                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">
                                                <h3>
                                                    <span class="label label-info"><i
                                                                class="mdi mdi-image-album"></i></span>
                                                    إضافة صور للمنتج (1140W x 536H) *
                                                </h3>
                                            </label>
                                            <input type="file" name="images[]" multiple
                                                   class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-info" type="submit">أدخل</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="row el-element-overlay" style="padding-top: 15px">
                            @foreach($item->images()->latest()->get() as $image)
                                <div class="col-md-3" id="img{{ $image->id }}">

                                    <!-- <div class="card"> -->
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"><img
                                                    src="{{ action('ImageController@show', $image->path) }}?h=347"
                                                    alt="Main Page"/>
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li>
                                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                                           href="{{ action('ImageController@show', $image->path) }}"
                                                           target="_blank"><i class="icon-magnifier"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                                           data-delete-image
                                                           href="#"><i
                                                                    class="icon-trash"></i></a>
                                                        <form action="{{ action('Admin\ItemController@destroyImage', $image) }}"
                                                              method="post" id="delete">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                        </form>

                                                    </li>

                                                    <li><a class="btn default btn-outline"
                                                           href="javascript:void(0);" data-editable
                                                           data-action="{{ action('Admin\ItemController@imageStatus', $image) }}"><i
                                                                    class="mdi {{ $image->active ? 'mdi-eye-outline-off' : 'mdi-eye-outline' }}"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script !src="">
        $('[data-delete-image]').click(function (e) {
            e.preventDefault();
            swal({
                title: "Are You Sure?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete($(this).parent().find('> #delete').attr('action'))
                            .then(function (response) {
                                console.log(response.data);
                                switch (response.data.status) {
                                    case '0':
                                        swal({
                                            title: response.data.message,
                                            dangerMode: true,
                                            icon: "danger"
                                        });
                                        break;
                                    case '1':
                                        $('#img' + response.data.id).remove();
                                        swal({
                                            title: response.data.message,
                                            dangerMode: false,
                                            button: true,
                                            icon: "success"
                                        });
                                }
                            })
                    } else {
                        swal("Canceled");
                    }
                });
        });
    </script>
@endsection