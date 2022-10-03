<?php

use Hushulin\LaravelEloquentRqlite\Tests\EloquentRqlite;
use Illuminate\Support\Facades\DB;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('rqlite transaction', function () {
    try {
        DB::connection('rqlite')->transaction(function () {
            EloquentRqlite::query()->where('id', 1)->update([
                'last_login_date' => date('Y-m-d'),
            ]);
            sleep(30);
        });
        expect(1)->toBeInt();
    } catch (Throwable $e) {
    }
})->skip(true);

it('rqlite model', function () {
    $c = EloquentRqlite::query()->first();
    dump('--------------- rqlite eloquent model first id ------------------', $c->id);
    expect($c)->toBeInstanceOf('Hushulin\LaravelEloquentRqlite\Tests\EloquentRqlite');
});

it('rqlite first', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->where('id', '<', 3)->first();
    dump('---------------- rqlite first ------------------', $c);
    expect($c)->toBeArray();
});

it('rqlite count 2 rows', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->where('id', '<', 3)->count();
    dump('----------- count 2 rows --------------', $c);
    expect($c)->toEqual(2);
});

it('rqlite insert get id and has no default value', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->insertGetId(['name' => 'eric hu'], 'laravel_eloquent_rqlite_table');
    dump('-------------insert get id --------------', $c);
    expect($c)->toBeInt();
});

it('rqlite insert get back data', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->insert(['name' => 'eric hu']);
    dump('---------------insert get affect object ---------', $c);
    expect($c)->toBeObject();
});

it('rqlite select 2 rows', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->take(2)->get();
    dump('---------- get 2 rows ------------', $c);
    expect($c)->toBeObject();
});

it('rqlite insert bind all param', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->insertGetId(['name' => 'ok', 'last_login_date' => date('Y-m-d')]);
    dump('-------------- insert get id with all fill -----------', $c);
    expect($c)->toBeInt();
});

it('rqlite table not found', function () {
    try {
        $c = DB::connection('rqlite')->table('not_found_table')->get();
        dump($c);
        expect($c)->toBeObject();
    } catch (\Exception $exception) {
        expect($exception->getMessage())->toEqual('no such table: not_found_table (SQL: select * from "not_found_table")');
    }
});

it('rqlite select 0 row', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->where('id', 1000)->get();
    dump('---------------- select no match item ------------------', $c);
    expect($c)->toBeObject();
});


it('rqlite paginate', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->paginate(10);
    dump('------------ paginate ---------', $c);
    expect($c)->toBeInstanceOf('Illuminate\Pagination\LengthAwarePaginator');
});

it('rqlite pluck', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->where('id', '<', 3)->pluck('name');
    dump('---------------- rqlite pluck ------------------', $c);
    expect($c)->toBeObject();
});

it('rqlite value', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->where('id', '<', 3)->value('name');
    dump('---------------- rqlite value ------------------', $c);
    expect($c)->toBeString();
});

