<?php

namespace App\Providers;

use App\Core\UrlGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // detect user language and set app locale
        if (in_array($s1 = Request::segment(1), App::getAdditionalLocales())) {
            // if first URL segment is in additional locales
            App::setLocale($s1);
            Carbon::setLocale($s1);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('url', function ($app) {
            return new UrlGenerator($app['router']->getRoutes(), $app['request']);
        });
    }
}
