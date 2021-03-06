<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router, Request $request)
    {
        $this->mapWebRoutes($router, $request);

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     * @param Router $router
     * @param Request $request
     */
    protected function mapWebRoutes(Router $router, Request $request)
    {
        $locale = $request->segment(1);

        if(in_array($locale, App::getSupportedLocales())) {
            App::setLocale($locale);
        } else {
            App::setLocale(App::getDefaultLocale());
        }

        $router->group(
            [
                'prefix' => App::getLocalePrefix(),
                'namespace' => $this->namespace
            ],

            function ($router) {
                require app_path('Http/routes.php');
            }
        );
    }
}
