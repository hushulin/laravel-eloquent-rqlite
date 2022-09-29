<?php


namespace Hushulin\LaravelEloquentRqlite\Driver;


use Doctrine\DBAL\Driver\Exception;

class RqliteResult implements \Doctrine\DBAL\Driver\Result
{

    /**
     * @inheritDoc
     */
    public function fetchNumeric()
    {
        // TODO: Implement fetchNumeric() method.
    }

    /**
     * @inheritDoc
     */
    public function fetchAssociative()
    {
        // TODO: Implement fetchAssociative() method.
    }

    /**
     * @inheritDoc
     */
    public function fetchOne()
    {
        // TODO: Implement fetchOne() method.
    }

    /**
     * @inheritDoc
     */
    public function fetchAllNumeric(): array
    {
        // TODO: Implement fetchAllNumeric() method.
        return [];
    }

    /**
     * @inheritDoc
     */
    public function fetchAllAssociative(): array
    {
        // TODO: Implement fetchAllAssociative() method.
        return [];
    }

    /**
     * @inheritDoc
     */
    public function fetchFirstColumn(): array
    {
        // TODO: Implement fetchFirstColumn() method.
        return [];
    }

    /**
     * @inheritDoc
     */
    public function rowCount(): int
    {
        // TODO: Implement rowCount() method.
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function columnCount(): int
    {
        // TODO: Implement columnCount() method.
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function free(): void
    {
        // TODO: Implement free() method.
    }
}
