<?php

namespace Hushulin\LaravelEloquentRqlite\Commands;

use Illuminate\Console\Command;

class LaravelEloquentRqliteCommand extends Command
{
    public $signature = 'laravel-eloquent-rqlite';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
