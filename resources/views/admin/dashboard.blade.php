@extends('admin.layouts.app')

@section('title')
    الرئيسية
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>أهلا بك في لوحة التحكم</h1>
                </div>
            </div>
        </div>
    </div>

    @if(isset($items))
        @include('admin.layouts.statistics')
    @endif

@endsection