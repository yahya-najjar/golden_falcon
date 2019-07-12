@extends('admin.layouts.app')
@section('title')
    {{ isset($item) ? 'تعديل' : 'إنشاء' }} {{ \App\Models\Item::getName($type) }}
@endsection

@section('bread')
    <li class="breadcrumb-item"><a
                href="{{ action('Admin\ItemController@index') }}?type={{$type}}">جميع {{ \App\Models\Item::getName($type,1) }}</a>
    </li>
    <li class="breadcrumb-item active">{{ isset($item) ? 'تعديل' : 'إنشاء' }} {{ \App\Models\Item::getName($type) }}</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{--<h4 class="card-title">{{ isset($item) ? 'تعديل' : 'إنشاء' }} {{ \App\Models\Item::getName($type) }}</h4>--}}

                    <form class="form-material" enctype="multipart/form-data"
                          action="{{ isset($item) ? action('Admin\ItemController@update', $item) : action('Admin\ItemController@store') }}"
                          method="post">
                        {{ csrf_field() }}

                        @if(isset($item))
                            {{ method_field('PATCH') }}
                        @endif

                        <input type="text" style="display: none;" value="{{$type}}" name="type"/>

                        <div class="row p-t-20">

                            @if(in_array($type, [\App\Models\Item::Category, \App\Models\Item::Product]))
                                <div class="col-md-12">
                                    <h3>
                                        <span class="label label-info">1</span>
                                        الفئة الأب
                                        *
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="parent" id="parent" class="form-control">
                                            @if($type != \App\Models\Item::Product)
                                                <option value="">أب عام</option>
                                            @endif
                                            @foreach($parents as $parent)
                                                <option {{ isset($item) ? ($parent->id == $item->parent_id ? 'selected' : '') : '' }} value="{{ $parent->id }}">
                                                    {{ $parent->title }}
                                                </option>
                                                @foreach($parent->children as $child)
                                                    @if($child->type != \App\Models\Item::Product)
                                                        @if((isset($item) and $item->id != $child->id) or (!isset($item)))
                                                            <option {{ isset($item) ? ($child->id == $item->parent_id ? 'selected' : '') : '' }} value="{{ $child->id }}">
                                                                - {{ $child->title }}
                                                            </option>
                                                        @endif

                                                        @if($type == \App\Models\Item::Product)
                                                            @foreach($child->children as $child2)
                                                                @if($child2->type != \App\Models\Item::Product)
                                                                    @if((isset($item) and $item->id != $child2->id) or (!isset($item)))
                                                                        <option {{ isset($item) ? ($child2->id == $item->parent_id ? 'selected' : '') : '' }} value="{{ $child2->id }}">
                                                                            -- {{ $child2->title }}
                                                                        </option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if($type != \App\Models\Item::SLIDER)
                                <div class="col-md-12">
                                    <h3>
                                        <span class="label label-info">2</span>
                                        العنوان
                                        *
                                    </h3>
                                </div>
                                @foreach(Localization::getSupportedLocales() as $key => $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_{{$key}}">({{$locale->native()}})</label>
                                            <input type="text" class="form-control form-control-line"
                                                   name="title_{{$key}}"
                                                   placeholder="{{$locale->native()}}.."
                                                   value="{{ isset($item) ? isset($item->translate($key)->title) ? $item->translate($key)->title : old('title_'. $key) ?? '' : old('title_'. $key) ?? '' }}"/>
                                        </div>
                                    </div>
                                @endforeach

                                @if($type != \App\Models\Item::Category)
                                    <div class="col-md-12">
                                        <h3>
                                            <span class="label label-info">3</span>
                                            المحتوى
                                            {{--*--}}
                                        </h3>
                                    </div>

                                    @foreach(Localization::getSupportedLocales() as $key => $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content_{{$key}}">
                                                    ({{$locale->native()}})
                                                </label>
                                                <textarea
                                                        class="{{ in_array($type, [\App\Models\Item::About]) ? 'mymce' : '' }} form-control form-control-line"
                                                        rows="10"
                                                        name="content_{{$key}}"
                                                        placeholder="Content {{$locale->native()}}.. ">{{ isset($item) ? isset($item->translate($key)->content) ? $item->translate($key)->content : old('content_'. $key) ?? '' : old('content_'. $key) ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">
                                        <h3>
                                            <span class="label label-info">4</span>
                                            الصورة الاساسية
                                            @php
                                                switch ($type){
                                                    case \App\Models\Item::SLIDER:
                                                    case \App\Models\Item::Category:
                                                        echo '1140W x 536H';
                                                        break;
                                                    case \App\Models\Item::About:
                                                        echo '1140W x 410H';
                                                        break;
                                                    case \App\Models\Item::Product:
                                                        echo '565W x 697H';
                                                        break;
                                                    default:
                                                        echo '720W x 480H';
                                                }
                                            @endphp
                                            {{ isset($item) ? '' : '*' }}
                                        </h3>
                                    </label>
                                    <input type="file" name="image" class="form-control form-control-line">
                                </div>
                            </div>

                            @if($type != \App\Models\Item::Category)
                                @if($type == \App\Models\Item::Product)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <h3>
                                                    <span class="label label-info">4</span>
                                                    صور أخرى
                                                    565W x 697H
                                                    {{ isset($item) ? '' : '*' }}
                                                </h3>
                                            </label>
                                            <input type="file" multiple name="images[]"
                                                   class="form-control form-control-line">
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if(isset($item))
                                <div class="col-md-12">
                                    @if(strpos($item->image, 'gif'))
                                        <img src="{{ url('storage/' . $item->image) }}" alt="" width="400" style="object-fit: cover">
                                    @else
                                        <img src="{{ action('ImageController@show', $item->image) }}?w=400" alt="">
                                    @endif
                                </div>

                            @endif

                            @if($type == \App\Models\Item::Product)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">
                                            <h3>
                                                <span class="label label-info">5</span>
                                                الألوان
                                                {{ isset($item) ? '' : '*' }}
                                            </h3>
                                        </label>
                                        <select multiple="multiple" type="file" name="colors[]"
                                                class="select2 select2-multiple form-control form-control-line">
                                            @foreach(\App\Models\CustomField::whereType(\App\Models\CustomField::COLOR)->get() as $color)
                                                <option style="background-color: {{ $color->value }}; color: {{ $color->value }}"
                                                        {{ isset($item) ? (isset($item->colors) ? (in_array($color->value, $item->colors) ? 'selected' : '') : '') : '' }}>
                                                    {{ $color->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">
                                            <h3>
                                                <span class="label label-info">5</span>
                                                القياسات
                                                {{ isset($item) ? '' : '*' }}
                                            </h3>
                                        </label>
                                        <select multiple="multiple" type="file" name="sizes[]"
                                                class="select2 select2-multiple form-control form-control-line">
                                            @foreach(\App\Models\CustomField::whereType(\App\Models\CustomField::SIZE)->get() as $size)
                                                <option {{ isset($item) ? (isset($item->sizes) ? (in_array($size->value, $item->sizes) ? 'selected' : '') : '') : '' }}>
                                                    {{ $size->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif


                            {{--@if($type == \App\Models\Item::SLIDER)--}}
                            {{--<div class="col-md-6">--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="link">--}}
                            {{--<h3>--}}
                            {{--<span class="label label-info">4</span>--}}
                            {{--Link--}}
                            {{--</h3>--}}
                            {{--</label>--}}
                            {{--<label for="link">Page/Website Link</label>--}}
                            {{--<input type="text" name="link" class="form-control"--}}
                            {{--value="{{ isset($item) ? $item->link : '' }}"--}}
                            {{--placeholder="Link of website or page (Optional)">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--@endif--}}

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
