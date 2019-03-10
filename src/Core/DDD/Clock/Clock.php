<?php

declare(strict_types=1);

namespace App\Core\DDD\Clock;

/**
 * Interface Clock
 *
 * @package App\Clock
 */
interface Clock
{
    public function now(): \DateTimeInterface;
}
