<?php

namespace App\Providers;

use Swift;
use Swift_DependencyContainer;
use Swift_Preferences;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Swift::init(function () {
            Swift_DependencyContainer::getInstance()
                ->register('mime.qpheaderencoder')
                ->asAliasOf('mime.base64headerencoder');

            Swift_Preferences::getInstance()->setCharset('iso-2022-jp');
        });
    }
}
