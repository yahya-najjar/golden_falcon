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
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable_t">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الأبناء</th>
                                    <th>خيارات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            <ul style="list-style: none">
                                                @foreach($category->children()->whereType(\App\Models\Item::Category)->get() as $child)
                                                    <li>
                                                        <a href="{{ action('Admin\ItemController@edit', $child->id) }}"
                                                           style="color: #2c2c2c;">
                                                            {{ $child->title }}
                                                        </a>

                                                        <a href="{{ action('Admin\ItemController@productsByCategory') }}?category={{ $child->id }}"
                                                           data-toggle="tooltip"
                                                           data-original-title="المنتجات">
                                                            <i class="mdi mdi-tshirt-v text-inverse"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" data-toggle="tooltip" data-delete
                                                           data-original-title="حذف"> <i
                                                                    class="mdi mdi-delete text-danger"></i> </a>
                                                        <form method="post"
                                                              action="{{ action('Admin\ItemController@destroy', $child->id) }}"
                                                              id="delete">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                        </form>
                                                        <ul style="list-style: none">
                                                            @foreach($child->children()->whereType(\App\Models\Item::Category)->get() as $child_more)
                                                                <li>
                                                                    <a href="{{ action('Admin\ItemController@edit', $child_more->id) }}"
                                                                       style="color: #5c5c5c;">
                                                                        {{ $child_more->title }}
                                                                    </a>

                                                                    <a href="{{ action('Admin\ItemController@productsByCategory') }}?category={{ $child_more->id }}"
                                                                       data-toggle="tooltip"
                                                                       data-original-title="المنتجات">
                                                                        <i class="mdi mdi-tshirt-v text-inverse"></i>
                                                                    </a>

                                                                    <a href="javascript:void(0)" data-toggle="tooltip"
                                                                       data-delete
                                                                       data-original-title="حذف"> <i
                                                                                class="mdi mdi-delete text-danger"></i>
                                                                    </a>
                                                                    <form method="post"
                                                                          action="{{ action('Admin\ItemController@destroy', $child_more->id) }}"
                                                                          id="delete">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                    </form>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="icons-custom" style="display: inline-block">
                                                <a href="{{ action('Admin\ItemController@edit', $category->id) }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="تعديل"><i
                                                            class="fa fa-pencil text-inverse"></i> </a>

                                                {{--<a data-editable--}}
                                                {{--data-action="{{ action('Admin\ItemController@change_status', $category) }}"--}}
                                                {{--data-toggle="tooltip"--}}
                                                {{--data-original-title="{{ $category->active ? 'تعطيل' : 'تفعيل' }}"><i--}}
                                                {{--class="fa {{ $category->active ? 'fa-circle-o-notch' : 'fa-power-off' }} text-inverse m-r-10"></i>--}}
                                                {{--</a>--}}

                                                <a href="javascript:void(0)"
                                                   data-action="{{ action('Admin\ItemController@change_home', $category) }}"
                                                   data-toggle="tooltip" data-editable data-original-title="رئيسية">
                                                    <i class="mdi {{ $category->home ? 'mdi-home-outline' : 'mdi-home' }} text-inverse"></i>
                                                </a>

                                                <a href="{{ action('Admin\ItemController@productsByCategory') }}?category={{ $category->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="المنتجات">
                                                    <i class="mdi mdi-tshirt-v text-inverse"></i>
                                                </a>


                                                <a href="javascript:void(0)" data-toggle="tooltip" data-delete
                                                   data-original-title="حذف">
                                                    <i class="mdi mdi-delete text-danger"></i> </a>
                                                <form method="post"
                                                      action="{{ action('Admin\ItemController@destroy', $category->id) }}"
                                                      id="delete">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection