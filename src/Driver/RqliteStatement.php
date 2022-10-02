<?php

namespace Hushulin\LaravelEloquentRqlite\Driver;

use Doctrine\DBAL\Driver\Result;
use Doctrine\DBAL\ParameterType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use PDOException;

class RqliteStatement extends \PDOStatement implements \Doctrine\DBAL\Driver\Statement
{
    /**
     * @var string
     */
    private string $sql;

    /**
     * @var Client
     */
    private Client $connection;

    /**
     * @var array
     */
    private array $parameterizedMap = [];

    public function __construct(string $sql, Client $connection)
    {
        $this->sql = $sql;
        $this->connection = $connection;
    }

    /**
     * {@inheritDoc}
     */
    public function bindValue($param, $value, $type = ParameterType::STRING)
    {
        $this->parameterizedMap[] = $value;
    }

    /**
     * {@inheritDoc}
     *
     * @throws GuzzleException
     */
    public function execute($params = null): Result
    {
        return new RqliteResult($this->requestRqliteByGuzzle());
    }

    /**
     * 没有pdo，写pdo方法覆盖
     *
     * @param null $how
     * @param null $class_name
     * @param null $ctor_args
     * @return array
     *
     * @throws GuzzleException
     */
    public function fetchAll($how = null, $class_name = null, $ctor_args = null)
    {
        $results = $this->requestRqliteByGuzzle();

        $results = $results[0];

        $tmp = [];
        if (isset($results['values'])) {
            foreach ($results['values'] as $key => $item) {
                foreach ($results['columns'] as $k => $i) {
                    //\PDO::FETCH_BOTH
                    //$tmp[$key][$k] = $item[$k];
                    $tmp[$key][$i] = $item[$k];
                }
            }
        }

        return $tmp;
    }

    /**
     * 构建 array of request json data
     *
     * @param  string  $sql
     * @param  array  $parameterizedMap
     * @return array[]
     */
    private function makeRequestData(string $sql, array $parameterizedMap): array
    {
        return [
            [$sql, ...$parameterizedMap],
        ];
    }

    /**
     * 执行后并返回结果
     *
     * @return mixed
     *
     * @throws GuzzleException
     */
    private function requestRqliteByGuzzle()
    {
        if (Str::startsWith(Str::upper($this->sql), ['SELECT', 'PRAGMA'])) {
            $uri = '/db/query';
        } else {
            $uri = '/db/execute';
        }

        $jsonOptionData = $this->makeRequestData($this->sql, $this->parameterizedMap);
        $response = $this->connection->post($uri, ['json' => $jsonOptionData]);
        $result = json_decode($response->getBody(), true);
        if (isset($result['results'])) {
            collect($result['results'])->map(function ($item) {
                if (isset($item['error'])) {
                    throw new PDOException($item['error']);
                }
            });
        }

        return $result['results'];
    }
}
