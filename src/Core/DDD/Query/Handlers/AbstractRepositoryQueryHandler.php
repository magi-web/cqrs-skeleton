<?php


namespace App\Core\DDD\Query\Handlers;


use App\Core\DDD\Query\Query;
use App\Core\DDD\Query\QueryHandler;
use App\Core\DDD\Repository;

class AbstractRepositoryQueryHandler implements QueryHandler
{
    /** @var Repository $repository */
    protected $repository;

    static protected $LISTEN_TO_CLASS = NULL;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    function handle(Query $query): array
    {
        if ($query instanceof $this::$LISTEN_TO_CLASS) {
            /** @var array $expiringProcedures */
            $items = $this->repository->find($query);
        } else {
            throw new \LogicException("L'objet query doit etre de type " . $this::$LISTEN_TO_CLASS . ". (".get_class($query)." transmis)");
        }

        return $items;
    }

    function listenTo(): string
    {
        return static::$LISTEN_TO_CLASS;
    }
}
