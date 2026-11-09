<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\AdminSetting;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $admin_setting = Cache::remember('admin_setting', 3600, function () {
                return AdminSetting::first();
            });
            $setting = Cache::remember('setting', 3600, function () {
                return Setting::first();
            });
            $menus = Cache::remember('menus', 3600, function () {
                return Menu::with(['rootItems', 'items'])->where('status', 1)->get();
            });
            $cart = session()->get('cart');
            $view->with(['setting' => $setting, 'admin_setting' => $admin_setting, 'cart' => $cart, 'menus' => $menus]);
        });
    }
}
