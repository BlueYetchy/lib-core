<?php

namespace BlueYetchy\LibCore\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'test-lib-core');
        $app['config']->set('database.connections.test-lib-core', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Load migrations for tests
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}