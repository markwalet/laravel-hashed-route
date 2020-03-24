<?php

namespace MarkWalet\LaravelHashedRoute\Tests;

use Illuminate\Foundation\Application;
use MarkWalet\LaravelHashedRoute\HashedRouteServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class LaravelTestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [HashedRouteServiceProvider::class];
    }
}
