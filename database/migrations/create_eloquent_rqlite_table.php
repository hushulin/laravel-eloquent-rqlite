<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('rqlite')->create('laravel_eloquent_rqlite_table', function (Blueprint $table) {
            $table->id();

            // add fields
            $table->string('name')->default('');
            $table->date('last_login_date')->default('');

            $table->timestamps();
        });
    }
};
