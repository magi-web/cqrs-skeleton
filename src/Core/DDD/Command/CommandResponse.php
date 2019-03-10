<?php

declare(strict_types=1);

namespace App\Core\DDD\Command;

use App\Core\DDD\Event\Event;

/**
 * Class CommandResponse
 *
 * @package App\Core\DDD\Command
 */
class CommandResponse
{
    protected $value;

    /** @var integer */
    private $status;

    /**
     * @var iterable|null
     */
    protected $events;

    /**
     * CommandResponse constructor.
     * @param mixed $value
     * @param int $status
     * @param iterable $events
     */
    public function __construct($value, int $status = 200, iterable $events = null)
    {
        $this->value = $value;

        $this->status = $status;

        $this->events = $events;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function status()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function hasEvents(): bool
    {
        return !empty($this->events);
    }

    /**
     * @return iterable|null
     */
    public function getEvents(): ?iterable
    {
        return $this->events;
    }
}
