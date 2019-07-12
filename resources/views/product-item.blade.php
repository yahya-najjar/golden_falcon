<div class="product-item">
    <div class="product-img">
        <a href="{{ action('SiteController@product', [$item->id, str_replace(' ', '_', $item->title)]) }}">
            <img src="{{ action('ImageController@show', $item->image) }}?w=277&h=347&fit=crop&blur=1"
                 alt="">
            <img src="{{ action('ImageController@show', $item->image) }}?w=277&h=347&fit=crop"
                 alt=""
                 class="back-img">
        </a>
        <a href="{{ action('SiteController@product', [$item->id, str_replace(' ', '_', $item->title)]) }}"
           class="product-quickview">@lang('welcomePage.seeMore')</a>
    </div>
    <div class="product-details">
        <h3>
            <a class="product-title" style="font-size: 120%"
               href="{{ action('SiteController@product', [$item->id, str_replace(' ', '_', $item->title)]) }}">{{ $item->title }}</a>
        </h3>
        <span class="price">
            @if(count($item->colors))
                @foreach(collect($item->colors)->take(4) as $color)
                    <span class="dot" style="background-color: {{ $color }}"></span>
                @endforeach
            @else
                <span>-</span>
            @endif
        </span><br>
        <span class="price">
            @if(count($item->sizes))
                @foreach(collect($item->sizes)->take(4) as $key =>$size)
                    <span>{{ $size . ($key+1 < count($item->sizes) ? ',' : '') }}</span>
                @endforeach
            @else
                <span>-</span>
            @endif
        </span>


    </div>
</div>