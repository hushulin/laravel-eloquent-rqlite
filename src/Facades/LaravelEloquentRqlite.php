<?php

namespace Hushulin\LaravelEloquentRqlite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hushulin\LaravelEloquentRqlite\LaravelEloquentRqlite
 */
class LaravelEloquentRqlite extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Hushulin\LaravelEloquentRqlite\LaravelEloquentRqlite::class;
    }
}
