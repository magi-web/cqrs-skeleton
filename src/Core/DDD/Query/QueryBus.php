<?php

declare(strict_types=1);

namespace App\Core\DDD\Query;

/**
 * Class QueryBus
 *
 * @package App\Core\DDD\Query
 */
class QueryBus
{
    /**
     * @var QueryHandler[]
     */
    private $handlers;

    /**
     * QueryBus constructor.
     *
     * @param iterable $handlers
     */
    public function __construct(iterable $handlers)
    {
        $this->handlers = [];

        foreach ($handlers as $handler) {
            if ($handler instanceof QueryHandler) {
                $this->handlers[$handler->listenTo()] = $handler;
            }
        }
    }

    /**
     * @param Query $query
     *
     * @return array
     */
    public function dispatch(Query $query): array
    {
        $queryClass = get_class($query);

        $parentClass = get_parent_class($query);
        if (array_key_exists($queryClass, $this->handlers) === false && !empty($parentClass)) {
            $queryClass = $parentClass;
        }

        if (array_key_exists($queryClass, $this->handlers) === false) {
            throw new \LogicException("No handler found for $queryClass");
        }

        $handler = $this->handlers[$queryClass];

        return $handler->handle($query);
    }
}
