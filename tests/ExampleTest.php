<?php

it('can test', function () {
    expect(true)->toBeTrue();
});

it('rqlite connect', function () {
    $c = \Illuminate\Support\Facades\DB::connection('rqlite')->table('test')->count();
    expect($c)->toBeInt();
});
