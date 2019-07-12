<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//language
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

// Site
Route::get('/', 'SiteController@welcome');
Route::get('about', 'SiteController@about');
Route::get('catalog/product/{id}/{title}', 'SiteController@product');
Route::get('catalog', 'SiteController@catalog');
Route::get('search', 'SiteController@search');

Route::post('contactMessage', 'SiteController@contact_post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('img/{path}', 'ImageController@show')->where('path', '.*');
// Admin Area
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    require_once base_path('routes/admin.php');
});