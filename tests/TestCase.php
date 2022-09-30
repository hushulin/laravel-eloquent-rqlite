<?php

namespace Hushulin\LaravelEloquentRqlite\Tests;

use Hushulin\LaravelEloquentRqlite\LaravelEloquentRqliteServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Hushulin\\LaravelEloquentRqlite\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelEloquentRqliteServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.rqlite.driver', 'rqlite');
        config()->set('database.connections.rqlite.host', 'http://rqlite-test.lyky.com.cn:80');
        config()->set('database.connections.rqlite.database', ':memory:');

        //$migration = include __DIR__.'/../database/migrations/create_eloquent_rqlite_table.php';
        //$migration->up();
    }
}
