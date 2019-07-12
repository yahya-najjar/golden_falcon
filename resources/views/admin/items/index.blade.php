@extends('admin.layouts.app')
@section('title')
    {{ \App\Models\Item::getName($type,1) }}
@endsection

@section('bread')
    <li class="breadcrumb-item active">جميع {{ \App\Models\Item::getName($type,1) }}</li>
@endsection

@section('content')

    @if(!count($items))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-danger">لايوجد أي {{ \App\Models\Item::getName($type) }} حتى الآن!
                        </h1><br>
                        <a href="{{ action('Admin\ItemController@create') }}?type={{$type}}"><h4><i
                                        class="mdi mdi-plus"></i> جديد
                            </h4></a>
                    </div>
                </div>
            </div>
        </div>

        @if($type == \App\Models\Item::Product and \App\Models\Item::whereType(\App\Models\Item::Product)->count())
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{ action('Admin\ItemController@search') }}" class="form">
                                    <div class="form-group">
                                        <label for="search">أبحث</label>
                                        <input required id="search" name="q" type="text" placeholder="ابحث عن منتج"
                                               class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">ابحث</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else

        @if($type == \App\Models\Item::Product)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{ action('Admin\ItemController@search') }}" class="form">
                                    <div class="form-group">
                                        <label for="search">أبحث</label>
                                        <input required id="search" name="q" type="text" placeholder="ابحث عن منتج"
                                               class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">ابحث</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row el-element-overlay">

            @foreach($items as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="el-card-item">
                            <div class="el-card-avatar el-overlay-1">
                                @if(strpos($item->image, 'gif'))
                                    <img src="{{ url('/storage/' . $item->image) }}" height="242px"
                                         alt="{{ $item->name }}"/>
                                @else
                                    <img src="{{ action('ImageController@show', $item->image) }}?w=720&h=480&fit=crop"
                                         alt="{{ $item->name }}"/>
                                @endif
                                <div class="el-overlay">
                                    <ul class="el-info">
                                        <li><a class="btn default btn-outline"
                                               href="{{ action('Admin\ItemController@edit', $item) }}"><i
                                                        class="icon-pencil"></i></a></li>
                                        <li><a class="btn default btn-outline" data-delete href="javascript:void(0);"><i
                                                        class="icon-trash"></i></a>
                                            <form action="{{ action('Admin\ItemController@destroy', $item) }}"
                                                  method="post" id="delete">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                            </form>
                                        </li>

                                        <li><a class="btn default btn-outline"
                                               href="javascript:void(0);" data-editable
                                               data-action="{{ action('Admin\ItemController@change_status', $item) }}"><i
                                                        class="mdi {{ $item->active ? 'mdi-eye-outline-off' : 'mdi-eye-outline' }}"></i></a>
                                        </li>

                                        @if(in_array($type, [\App\Models\Item::Product]))
                                            <li><a class="btn default btn-outline"
                                                   href="javascript:void(0);" data-editable
                                                   data-action="{{ action('Admin\ItemController@change_home', $item) }}"><i
                                                            class="mdi {{ $item->home ? 'mdi-home-outline' : 'mdi-home' }}"></i></a>
                                            </li>
                                        @endif

                                        @if($type == \App\Models\Item::Product)
                                            <li><a class="btn default btn-outline"
                                                   href="{{ action('Admin\ItemController@imagesForm', $item) }}"><i
                                                            class="mdi mdi-image-album"></i></a>
                                            </li>
                                        @endif

                                        {{--@if($type == \App\Models\Item::Course)--}}
                                        {{--<li><a class="btn default btn-outline" data-editable--}}
                                        {{--data-action="{{ action('Admin\ItemController@change_registration_status', $item) }}"><i--}}
                                        {{--class="mdi {{ $item->registerOpen ? 'mdi-lock' : 'mdi-lock-open' }}"></i></a>--}}
                                        {{--</li>--}}
                                        {{--<li><a class="btn default btn-outline"--}}
                                        {{--href="{{ action('Admin\CourseRegistrationController@index') }}?item_id={{ $item->id }}"><i--}}
                                        {{--class="mdi mdi-format-list-bulleted"></i></a>--}}
                                        {{--</li>--}}
                                        {{--@endif--}}

                                    </ul>
                                </div>
                            </div>
                            @if($type != \App\Models\Item::SLIDER)
                                <div class="el-card-content">
                                    <h3 class="box-title">
                                        {{ $item->translate('ar')->title }}
                                    </h3>
                                    @if($type == \App\Models\Item::Product)
                                        <p>
                                            <a href="{{ action('Admin\ItemController@productsByCategory') }}?category={{ $item->parent->id }}">
                                                <small><strong>{{ $item->parent->translate('ar')->title }}</strong>
                                                </small>
                                            </a>
                                        </p>
                                    @endif
                                    <small>{{ str_limit(str_replace('&nbsp;' , ' ', strip_tags($item->translate('ar')->content))) }}</small>
                                    <br/>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection