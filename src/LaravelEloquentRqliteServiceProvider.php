<?php

namespace Hushulin\LaravelEloquentRqlite;

use Hushulin\LaravelEloquentRqlite\Commands\LaravelEloquentRqliteCommand;
use Hushulin\LaravelEloquentRqlite\Driver\RqliteDriver;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\SQLiteConnection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelEloquentRqliteServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-eloquent-rqlite')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-eloquent-rqlite_table')
            ->hasCommand(LaravelEloquentRqliteCommand::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->app->bind('db.connector.rqlite', function () {
            return new RqliteDriver();
        });

        $this->app->make('db')->resolverFor('rqlite', function ($connection, $database, $prefix, $config) {
            return new SQLiteConnection($connection, $database, $prefix, $config);
        });
    }
}
