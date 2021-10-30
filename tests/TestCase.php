<?php

namespace Aammui\LaravelParser\Tests;

use Aammui\LaravelParser\LaravelParserServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelParserServiceProvider::class,
        ];
    }
}
