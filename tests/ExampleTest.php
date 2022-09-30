<?php

use Illuminate\Support\Facades\DB;

it('can test', function () {
    expect(true)->toBeTrue();
});


it('rqlite count 2 rows', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->where('id', '<', 3)->count();
    dump('----------- count 2 rows --------------',$c);
    expect($c)->toEqual(2);
});

it('rqlite insert get id and has no default value', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->insertGetId(['name' => 'eric hu'], 'laravel_eloquent_rqlite_table');
    dump($c);
    expect($c)->toBeInt();
});


it('rqlite insert get back data', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->insert(['name' => 'eric hu']);
    dump($c);
    expect($c)->toBeObject();
});


it('rqlite select 2 rows', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->take(2)->get();
    dump('---------- get 2 rows ------------', $c);
    expect($c)->toBeObject();
});

it('rqlite insert bind all param', function () {
    $c = DB::connection('rqlite')->table('laravel_eloquent_rqlite_table')->insertGetId(['name' => 'ok', 'last_login_date' => date('Y-m-d')]);
    dump($c);
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
    dump($c);
    expect($c)->toBeObject();
});
