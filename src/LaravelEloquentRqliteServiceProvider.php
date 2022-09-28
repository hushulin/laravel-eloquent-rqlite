<?php

namespace Hushulin\LaravelEloquentRqlite;

use Hushulin\LaravelEloquentRqlite\Commands\LaravelEloquentRqliteCommand;
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
}
