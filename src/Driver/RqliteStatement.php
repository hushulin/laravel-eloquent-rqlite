<?php


namespace Hushulin\LaravelEloquentRqlite\Driver;


use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Driver\Result;
use Doctrine\DBAL\ParameterType;

class RqliteStatement extends \PDOStatement implements \Doctrine\DBAL\Driver\Statement
{

    /**
     * @inheritDoc
     */
    public function bindValue($param, $value, $type = ParameterType::STRING)
    {
        // TODO: Implement bindValue() method.
    }

    /**
     * @inheritDoc
     */
    public function execute($params = null): Result
    {
        // TODO: Implement execute() method.

        //try {
        //    $response = $this->connection->post('/db/execute', ['json' => [[$sql]]]);
        //    Log::debug($response->getBody());
        //    $result = json_decode($response->getBody(), true);
        //    if (isset($result[0]['error'])) {
        //        throw new \PDOException($result[0]['error']);
        //    }
        //    $this->lastInsertId = $result['results']['last_insert_id'] ?? 0;
        //
        //    return $result['results']['rows_affected'] ?? 0;
        //} catch (GuzzleException $e) {
        //    return 0;
        //}

        return new RqliteResult();
    }
}
