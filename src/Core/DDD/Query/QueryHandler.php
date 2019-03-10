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
    function handle(Query $query): array;

    function listenTo(): string;
}
