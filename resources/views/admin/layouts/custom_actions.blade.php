<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                class="mdi mdi-file-image"></i>
        <span class="hide-menu">
                        شريط الصور
                    </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ action('Admin\ItemController@index') }}?type=1">الكل </a></li>
        <li><a href="{{ action('Admin\ItemController@create') }}?type=1">جديد </a></li>
    </ul>
</li>

<li><a class="waves-effect waves-dark" href="{{ action('Admin\ItemController@edit', 1) }}" aria-expanded="false"><i
                class="mdi mdi-message-text-outline"></i>
        <span class="hide-menu">
                        صفحة من نحن
        </span></a>
</li>

<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                class="mdi mdi-invert-colors"></i>
        <span class="hide-menu">
                        الألوان
                    </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ action('Admin\CustomFieldController@index') }}?type=1">الكل </a></li>
        <li><a href="{{ action('Admin\CustomFieldController@create') }}?type=1">جديد </a></li>
    </ul>
</li>

<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                class="mdi mdi-ruler"></i>
        <span class="hide-menu">
                        القياسات
                    </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ action('Admin\CustomFieldController@index') }}?type=2">الكل </a></li>
        <li><a href="{{ action('Admin\CustomFieldController@create') }}?type=2">جديد </a></li>
    </ul>
</li>


<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                class="mdi mdi-sitemap"></i>
        <span class="hide-menu">
                        الفئات
                    </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ action('Admin\ItemController@index') }}?type=2">الكل </a></li>
        <li><a href="{{ action('Admin\ItemController@create') }}?type=2">جديد </a></li>
    </ul>
</li>


<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                class="mdi mdi-headphones"></i>
        <span class="hide-menu">
                        المنتجات
                    </span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ action('Admin\ItemController@index') }}?type=3">الكل </a></li>
        <li><a href="{{ action('Admin\ItemController@create') }}?type=3">جديد </a></li>
    </ul>
</li>