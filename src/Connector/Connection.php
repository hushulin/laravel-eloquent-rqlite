<?php

namespace Hushulin\LaravelEloquentRqlite\Connector;

use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Driver\Result;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\ParameterType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hushulin\LaravelEloquentRqlite\Driver\RqliteStatement;
use PDOException;

final class Connection implements \Doctrine\DBAL\Driver\Connection
{
    /**
     * @var Client
     */
    private Client $connection;

    /** @internal The connection can be only instantiated by its driver. */
    public function __construct(Client $connection)
    {
        $this->connection = $connection;
    }

    public function prepare(string $sql): Statement
    {
        return new RqliteStatement($sql, $this->connection);
    }

    /**
     * 查询
     *
     * @param  string  $sql
     * @return Result
     *
     * @throws Exception
     */
    public function query(string $sql): Result
    {
        return $this->prepare($sql)->execute();
    }

    /**
     * 给变量加引号，来自oci8的实现：如果是numeric 直接返回。如果是'再加一个'，如果是特殊字符，加转义
     *
     * @see \Doctrine\DBAL\Driver\OCI8\Connection::quote
     *
     * @param  mixed  $value
     * @param  int  $type
     * @return float|int|string
     */
    public function quote($value, $type = ParameterType::STRING)
    {
        if (is_int($value) || is_float($value)) {
            return $value;
        }

        $value = str_replace("'", "''", $value);

        return "'".addcslashes($value, "\000\n\r\\\032")."'";
    }

    /**
     * 执行并返回影响行数
     *
     * @param  string  $sql
     * @return int
     *
     * @throws Exception
     */
    public function exec(string $sql): int
    {
        return $this->prepare($sql)->execute()->rowCount();
    }

    /**
     * @todo 返回上次插入的主键值，未实现
     *
     * @param  null  $name
     * @return int
     */
    public function lastInsertId($name = null): int
    {

        if ($name == null) {
            return 0;
        }

        try {
            $res = $this->connection->post('/db/query', ['json' => ['SELECT seq FROM sqlite_sequence WHERE name = ' . $this->quote($name)]]);
            $result = json_decode($res->getBody(), true);
            if (isset($result['results'])) {
                collect($result['results'])->map(function ($item) {
                    if (isset($item['error'])) {
                        throw new PDOException($item['error']);
                    }
                });
            }
            return (int) $result['results'][0]['values'][0][0];
        } catch (GuzzleException | PDOException $e) {
            return 0;
        }
    }

    public function beginTransaction()
    {
        try {
            $this->connection->post('/db/execute', ['json' => ['BEGIN']]);
        } catch (GuzzleException $e) {
        }
    }

    public function commit()
    {
        try {
            $this->connection->post('/db/execute', ['json' => ['COMMIT']]);
        } catch (GuzzleException $e) {
        }
    }

    public function rollBack()
    {
        try {
            $this->connection->post('/db/execute', ['json' => ['ROLLBACK']]);
        } catch (GuzzleException $e) {
        }
    }

    /**
     * 原生连接没有，返回http client 代替 pdo connection
     *
     * @return Client
     */
    public function getNativeConnection(): Client
    {
        return $this->connection;
    }
}
