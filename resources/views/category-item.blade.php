<div class="product-item">
    <div class="product-img">
        <a href="{{ action('SiteController@catalog') }}?category={{ $item->id }}">
            <img src="{{ action('ImageController@show', $item->image) }}?w=277&h=347&fit=crop&blur=3"
                 alt="">
            <img src="{{ action('ImageController@show', $item->image) }}?w=277&h=347&fit=crop"
                 alt=""
                 class="back-img">
        </a>
        <a href="{{ action('SiteController@catalog') }}?category={{ $item->id }}"
           class="product-quickview">@lang('welcomePage.seeMore')</a>
    </div>
    <div class="product-details">
        <h3>
            <a class="product-title" style="font-size: 120%"
               href="{{ action('SiteController@catalog') }}?category={{ $item->id }}">{{ $item->title }}</a>
        </h3>
    </div>
</div>