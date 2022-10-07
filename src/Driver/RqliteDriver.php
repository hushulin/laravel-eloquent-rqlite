<?php

namespace Hushulin\LaravelEloquentRqlite\Driver;

use Doctrine\DBAL\Driver\AbstractSQLiteDriver;
use GuzzleHttp\Client;
use Hushulin\LaravelEloquentRqlite\Connector\Connection;

class RqliteDriver extends AbstractSQLiteDriver
{
    /**
     * @param  array  $params
     * @return Connection
     */
    public function connect(array $params): Connection
    {
        $connection = $this->createConnection($params);

        return new Connection($connection);
    }

    /**
     * Create a guzzle http client for rqlite
     *
     * @param  array  $params
     * @return Client
     */
    private function createConnection(array $params): Client
    {
        if (isset($params['username']) && ! empty($params['username'])) {
            return new Client([
                'base_uri' => $params['host'],
                'allow_redirects' => true,
                'auth' => [$params['username'], $params['password']],
            ]);
        } else {
            return new Client([
                'base_uri' => $params['host'],
                'allow_redirects' => true,
            ]);
        }
    }
}
