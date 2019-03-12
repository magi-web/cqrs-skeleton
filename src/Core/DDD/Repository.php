<?php

declare(strict_types=1);

namespace App\Core\DDD;

/**
 * Interface Repository
 *
 * @package App\Core\DDD
 */
interface Repository
{
    public function get($id): ?object;
    public function add($entity): void;
    public function delete($id): void;
}
