<?php


Route::get('/', function () {
//    $items = array(
//        array(
//            'name' => 'Slides',
//            'icon' => 'mdi-file-image',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::SLIDER)->count()
//        ),
//        array(
//            'name' => 'Services',
//            'icon' => 'mdi-settings-box',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::SERVICE)->count()
//        ),
//        array(
//            'name' => 'Tips',
//            'icon' => 'mdi-comment-text',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::TIP)->count()
//        ),
//        array(
//            'name' => 'Activities',
//            'icon' => 'mdi-calendar-plus',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::ACTIVITY)->count()
//        ),
//        array(
//            'name' => 'Courses',
//            'icon' => 'mdi-book-open-page-variant',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::Course)->count()
//        ),
//        array(
//            'name' => 'Team Members',
//            'icon' => 'mdi-account-multiple',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::TeamMember)->count()
//        ),
//        array(
//            'name' => 'Partners',
//            'icon' => 'mdi-account-circle',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::Partner)->count()
//        ),
//        array(
//            'name' => 'Gallery',
//            'icon' => 'mdi-folder-image',
//            'count' => \App\Models\Item::whereType(\App\Models\Item::Gallery)->count()
//        ),
//
//    );
//    return view('admin.dashboard', compact('items'));
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('settings', 'SettingController', [
    'only' => ['index', 'store'],
]);

Route::resource('user', 'UserController');
Route::resource('item', 'ItemController');
Route::get('items', 'ItemController@productsByCategory');
Route::resource('custom_field', 'CustomFieldController');
Route::post('item/change_status/{item}', 'ItemController@change_status');
Route::post('item/change_home/{item}', 'ItemController@change_home');

Route::get('items/search', 'ItemController@search');

Route::post('item/images/storeImages/{item}', 'ItemController@storeImages');
Route::delete('item/images/deleteImage/{image}', 'ItemController@destroyImage');
Route::post('item/images/statusImage/{image}', 'ItemController@imageStatus');
Route::get('item/images/{item}', 'ItemController@imagesForm');

Route::post('notifications/markAllRead', 'NotificationController@markAllRead');
Route::post('notifications/markAsRead', 'NotificationController@markAsRead');