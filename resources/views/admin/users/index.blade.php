@extends('admin.layouts.app')
@section('title')
    المستخدمين
@endsection

@section('bread')
    <li class="breadcrumb-item active">المستخدمين</li>
@endsection


@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                @if(!count($users))
                    <h1 class="text-danger">لا يوجد مستخدمين حتى الآن<i class="mdi mdi-emoticon-neutral"></i>
                    </h1><br>
                    <a href="{{ action('Admin\UserController@create') }}"><h4><i class="mdi mdi-plus"></i> جديد
                        </h4></a>
                @else
                    <h4 class="card-title">إدارة المستخدمين</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>اسم المتسخدم</th>
                                {{--<th>الصلاحية</th>--}}
                                <th>خيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{--<td><span class="label label-{{ $user->role == 1 ? 'success' : ($user->role == 2 ? 'warning' : 'info') }}">{{ $user->role == 1 ? 'مدير عام' : ($user->role == 2 ? 'موارد بشرية' : 'مدخل بيانات') }}</span></td>--}}
                                    <td>
                                        <a href="{{ action('Admin\UserController@edit', $user) }}" data-toggle="tooltip"
                                           data-original-title="Edit"> <i
                                                    class="fa fa-pencil text-inverse m-r-10"></i> </a>

                                        @if(count($users) > 2 && Auth::id() != $user->id)
                                            <a href="#" data-toggle="tooltip" data-delete data-original-title="Delete">
                                                <i
                                                        class="fa fa-trash text-danger"></i> </a>
                                            <form method="post"
                                                  action="{{ action('Admin\UserController@destroy', $user) }}"
                                                  id="delete">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        @endif
                                        @if(Auth::id() == $user->id)
                                            <span class="label label-info">حسابك</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection