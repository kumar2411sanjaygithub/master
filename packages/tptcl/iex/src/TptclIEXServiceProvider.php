<?php

namespace Tptcl\Iex;

use Illuminate\Support\ServiceProvider;

class TptclIEXServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       include __DIR__.'/routes.php';
       //$this->loadViewsFrom(__DIR__.'/views', 'iex');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/theme'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Tptcl\Iex\Controller\TptclIexController');
        $this->loadViewsFrom(__DIR__.'/views', 'iex');
    }
}
