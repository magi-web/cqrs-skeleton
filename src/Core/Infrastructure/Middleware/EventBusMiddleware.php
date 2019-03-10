<?php


namespace App\Core\Infrastructure\Middleware;

use App\Core\DDD\Command\Command;
use App\Core\DDD\Command\CommandBusMiddleware;
use App\Core\DDD\Command\CommandResponse;
use App\Core\Infrastructure\CommandBus;
use App\Core\Infrastructure\EventBus;

/**
 * Class EventBusMiddleware
 *
 * @package App\Core\Middleware
 */
class EventBusMiddleware extends CommandBus implements CommandBusMiddleware
{
    /**
     * @var CommandBusMiddleware
     */
    private $bus;

    /**
     * @var EventBus
     */
    private $eventBus;

    /**
     * EventBusMiddleware constructor.
     *
     * @param EventBus $eventBus
     */
    function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    function setNextBus(CommandBusMiddleware $next): CommandBusMiddleware
    {
        $this->bus = $next;

        return $this;
    }

    /**
     * @param Command $command
     *
     * @return CommandResponse
     */
    public function dispatch(Command $command): CommandResponse
    {
        $commandResponse = $this->bus->dispatch($command);
        if ($commandResponse->hasEvents() && is_array($commandResponse->getEvents())) {
            foreach ($commandResponse->getEvents() as $event) {
                $this->eventBus->dispatch($event);
            }
        }

        return $commandResponse;
    }
}
