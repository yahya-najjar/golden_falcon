@extends('admin.layouts.app')
@section('title')
    {{ \App\Models\CustomField::getName($type,1) }}
@endsection

@section('bread')
    <li class="breadcrumb-item active">جميع {{ \App\Models\CustomField::getName($type,1) }}</li>
@endsection

@section('content')

    @if(!count($fields))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-danger">لايوجد أي {{ \App\Models\CustomField::getName($type) }} حتى الآن!
                        </h1><br>
                        <a href="{{ action('Admin\CustomFieldController@create') }}?type={{$type}}"><h4><i
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
                                    <th>القيمة</th>
                                    <th>خيارات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fields as $field)
                                    <tr>
                                        <td>{{ $field->id }}</td>
                                        @if($type == \App\Models\CustomField::COLOR)
                                            <td>
                                                <span class="label" style="background-color: {{ $field->value }}">
                                                    {{ $field->value }}
                                                </span>
                                            </td>
                                        @else
                                            <td>{{ $field->value }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ action('Admin\CustomFieldController@edit', $field->id) }}"
                                               data-toggle="tooltip"
                                               data-original-title="تعديل"><i
                                                        class="fa fa-pencil text-inverse m-r-10"></i> </a>

                                            {{--<a data-editable--}}
                                            {{--data-action="{{ action('Admin\CustomFieldController@change_status', $field) }}"--}}
                                            {{--data-toggle="tooltip"--}}
                                            {{--data-original-title="{{ $field->active ? 'تعطيل' : 'تفعيل' }}"><i--}}
                                            {{--class="fa {{ $field->active ? 'fa-circle-o-notch' : 'fa-power-off' }} text-inverse m-r-10"></i>--}}
                                            {{--</a>--}}


                                            <a href="#" data-toggle="tooltip" data-delete data-original-title="حذف"> <i
                                                        class="fa fa-trash text-danger"></i> </a>
                                            <form method="post"
                                                  action="{{ action('Admin\CustomFieldController@destroy', $field->id) }}"
                                                  id="delete">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>

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