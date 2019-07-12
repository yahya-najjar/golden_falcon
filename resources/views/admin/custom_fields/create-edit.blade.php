@extends('admin.layouts.app')
@section('title')
    {{ isset($field) ? 'تعديل' : 'إنشاء' }} {{ \App\Models\CustomField::getName($type) }}
@endsection

@section('bread')
    <li class="breadcrumb-item"><a
                href="{{ action('Admin\CustomFieldController@index') }}?type={{$type}}">جميع {{ \App\Models\CustomField::getName($type,1) }}</a>
    </li>
    <li class="breadcrumb-item active">{{ isset($field) ? 'تعديل' : 'إنشاء' }} {{ \App\Models\CustomField::getName($type) }}</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{--<h4 class="card-title">{{ isset($field) ? 'تعديل' : 'إنشاء' }} {{ \App\Models\CustomField::getName($type) }}</h4>--}}

                    <form class="form-material" enctype="multipart/form-data"
                          action="{{ isset($field) ? action('Admin\CustomFieldController@update', $field) : action('Admin\CustomFieldController@store') }}"
                          method="post">
                        {{ csrf_field() }}

                        @if(isset($field))
                            {{ method_field('PATCH') }}
                        @endif

                        <input type="text" style="display: none;" value="{{$type}}" name="type"/>

                        <div class="row p-t-20">

                            @if(\App\Models\CustomField::COLOR == $type)
                                <div class="col-md-12">
                                    <h3>
                                        <span class="label label-info">1</span>
                                        اللون
                                        *
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="color" class="form-control"
                                               value="{{ isset($field) ? $field->value : '' }}" name="value">
                                    </div>
                                </div>
                            @endif

                            @if(\App\Models\CustomField::SIZE == $type)
                                <div class="col-md-12">
                                    <h3>
                                        <span class="label label-info">1</span>
                                        القياس
                                        *
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                               value="{{ isset($field) ? $field->value : '' }}" name="value">
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-success btn-rounded" type="submit">تأكيد</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
