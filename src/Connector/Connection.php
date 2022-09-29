<?php


namespace Hushulin\LaravelEloquentRqlite\Connector;


use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Driver\Result;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\ParameterType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

final class Connection implements \Doctrine\DBAL\Driver\Connection
{

    /**
     * @var Client $connection
     */
    private $connection;

    private $lastInsertId = 0;

    /** @internal The connection can be only instantiated by its driver. */
    public function __construct(Client $connection)
    {
        $this->connection = $connection;
    }

    public function prepare(string $sql): Statement
    {
        // TODO: Implement prepare() method.
    }

    public function query(string $sql): Result
    {
        // TODO: Implement query() method.
    }

    public function quote($value, $type = ParameterType::STRING)
    {
        // TODO: Implement quote() method.
    }

    public function exec(string $sql): int
    {
        try {
            $response = $this->connection->post('/db/execute', ['json' => [[$sql]]]);
            $result = json_decode($response->getBody(),true);
            if (isset($result[0]['error'])) {
                throw new \PDOException($result[0]['error']);
            }
            $this->lastInsertId = $result['results']['last_insert_id'] ?? 0;
            return $result['results']['rows_affected'] ?? 0;
        }catch (GuzzleException $e) {
            return 0;
        }
    }

    public function lastInsertId($name = null)
    {
        return $this->lastInsertId;
    }

    public function beginTransaction()
    {
    }

    public function commit()
    {
    }

    public function rollBack()
    {
    }

    public function getNativeConnection(): Client
    {
        return $this->connection;
    }
}
