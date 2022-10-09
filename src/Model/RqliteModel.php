<?php

namespace Hushulin\LaravelEloquentRqlite\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RqliteModel extends Model
{
    /**
     * @var string 设置连接
     */
    protected $connection = 'rqlite';

    protected function insertAndSetId(Builder $query, $attributes)
    {
        $keyName = $this->getKeyName();

        $id = $query->insertGetId($attributes, $this->getTable());

        $this->setAttribute($keyName, $id);
    }
}
