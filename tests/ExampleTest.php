<?php

use Illuminate\Support\Facades\DB;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('rqlite connect', function () {
    $c = DB::connection('rqlite')->table('test')->insertGetId(['name' => 'ok']);
    expect($c)->toBeInt();
});

it('rqlite select', function () {
    $c = DB::connection('rqlite')->table('test')->where('id', 1)->get();
    expect($c)->toBeObject();
});
