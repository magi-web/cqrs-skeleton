<?php

declare(strict_types=1);

namespace App\Core\DDD\Query;

/**
 * Interface QueryHandler
 *
 * @package App\Core\DDD\Query
 */
interface QueryHandler
{
    /**
     * Function to process the query
     *
     * @param Query $query
     *
     * @return array
     */
    function handle(Query $query): array;

    /**
     * Returns the class handled
     *
     * @return string
     */
    function listenTo(): string;
}
