<?php

namespace Hushulin\LaravelEloquentRqlite\Tests;

class EloquentRqlite extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'laravel_eloquent_rqlite_table';

    public $timestamps = false;

    protected $fillable = ['name', 'last_login_date'];

    protected $connection = 'rqlite';
}
