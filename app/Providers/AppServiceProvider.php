<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {

            if (!Cache::has('site_settings')) {
                $settings = Cache::rememberForever('site_settings', function () {
                    $settings = Setting::rows();
                    return $settings;
                });
            } else {
                $settings = Cache::get('site_settings');
            }


            return [
                $view->with('settings', $settings),
            ];
        });

        view()->composer('layouts.nav', function ($view) {

            $menuCategories = Item::hasProductsHomeMenu()->get();

            return [
                $view->with('menuCategories', $menuCategories),
            ];
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
