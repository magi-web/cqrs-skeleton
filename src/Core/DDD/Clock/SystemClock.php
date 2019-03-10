<?php

declare(strict_types=1);

namespace App\Core\DDD\Clock;

/**
 * Class SystemClock
 *
 * @package App\Clock
 */
final class SystemClock implements Clock
{
    /**
     * @return \DateTimeInterface
     * @throws \Exception
     */
    public function now(): \DateTimeInterface
    {
        return new \DateTimeImmutable();
    }
}
