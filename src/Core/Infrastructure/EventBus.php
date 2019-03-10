<?php

namespace App\Core\Infrastructure;


use App\Core\DDD\Event\Event;
use App\Core\DDD\Event\EventBus as EventBusInterface;

/**
 * Class EventBus
 *
 * @package App\Core\DDD
 */
class EventBus implements EventBusInterface
{
    private $handlers;

    function __construct(iterable $handlers)
    {
        $this->handlers = [];
        foreach ($handlers as $handler) {
            $this->handlers [] = $handler;
        }
    }

    /**
     * @param Event $event
     */
    public function dispatch(Event $event): void
    {
        $eventClass = get_class($event);
        $matchingHandlers = array_filter(
            $this->handlers,
            function ($handler) use ($eventClass) {
                return $handler->listenTo() === $eventClass;
            }
        );
        if (is_array($matchingHandlers)) {
            foreach ($matchingHandlers as $handler) {
                $handler->handle($event);
            }
        }
    }
}
