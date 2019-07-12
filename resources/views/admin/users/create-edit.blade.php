@extends('admin.layouts.app')
@section('title')
    {{ isset($user) ? 'نعديل' : 'إنشاء' }} مستخدم
@endsection

@section('bread')
    <li class="breadcrumb-item"><a href="{{ action('Admin\UserController@index') }}">المستخدمين</a></li>
    <li class="breadcrumb-item active">{{ isset($user) ? 'نعديل' : 'إنشاء' }} مستخدم</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($user) ? 'نعديل' : 'إنشاء' }} مستخدم</h4>

                    <form class="form-material" enctype="multipart/form-data"
                          action="{{ isset($user) ? action('Admin\UserController@update', $user) : action('Admin\UserController@store') }}"
                          method="post">
                        {{ csrf_field() }}

                        @if(isset($user))
                            {{ method_field('PATCH') }}
                        @endif

                        <div class="row p-t-20">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control form-control-line"
                                           name="name"
                                           placeholder="Name"
                                           value="{{ isset($user) ? $user->name : old('name') ?? '' }}"/>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">اسم المستخدم</label>
                                    <input type="text" class="form-control form-control-line"
                                           name="email"
                                           placeholder="Username"
                                           value="{{ isset($user) ? $user->email : old('email') ?? '' }}"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">كلمة السر</label>
                                    <input type="text" class="form-control form-control-line"
                                           name="password"
                                           placeholder="Password"
                                           value=""/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">تأكيد كلمة السر</label>
                                    <input type="text" class="form-control form-control-line"
                                           name="password_confirmation"
                                           placeholder="Confirm"
                                           value=""/>
                                </div>
                            </div>

                            {{--<div class="col-md-12">--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="role">دور المدير (الصلاحية)</label>--}}
                            {{--<select name="role" id="role" class="form-control">--}}
                            {{--<option value="1" {{ isset($user) ? $user->role == 1 ? 'selected' : '' : '' }}>مدير عام</option>--}}
                            {{--<option value="2" {{ isset($user) ? $user->role == 2 ? 'selected' : '' : '' }}>موارد بشرية</option>--}}
                            {{--<option value="3" {{ isset($user) ? $user->role == 3 ? 'selected' : '' : '' }}>مدخل بيانات</option>--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--</div>--}}

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
