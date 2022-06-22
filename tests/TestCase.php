<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [TestServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('view.paths', [
            __DIR__ . '/../resources/views',
        ]);
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZqNQHslgDWYfiBfCuSThJ5SK8=');
    }
}
