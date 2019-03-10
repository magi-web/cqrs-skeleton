<?php

declare(strict_types=1);

namespace App\Core\DDD;


use App\Core\DDD\Query\Query;

interface Repository
{
    public function get($id): ?object;
    public function add($entity): void;
    public function delete($id): void;

    /**
     * @return array
     */
    public function findAll();
    public function find(Query $query, $lockMode = NULL, $lockVersion = NULL);
}
