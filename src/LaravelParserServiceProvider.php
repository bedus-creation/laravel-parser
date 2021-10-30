<?php

namespace Aammui\LaravelParser;

use Aammui\LaravelParser\Parser\PHPSoup;
use Illuminate\Support\ServiceProvider;

class LaravelParserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('php-soup', function ($app) {
            return new PHPSoup();
        });
    }
}
