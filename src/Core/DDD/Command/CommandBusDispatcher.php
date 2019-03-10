<?php


namespace App\Core\DDD\Command;


use App\Core\Infrastructure\CommandBus;

/**
 * Class CommandBusDispatcher
 *
 * @package App\Core\DDD\Command
 */
class CommandBusDispatcher extends CommandBus implements CommandBusMiddleware
{
    private $handlers;

    function setNextBus(CommandBusMiddleware $next): CommandBusMiddleware
    {
        return $this;
    }


    /**
     * CommandBusDispatcher constructor.
     *
     * @param CommandHandler[] $handlers
     */
    public function __construct(iterable $handlers)
    {
        $this->handlers = [];

        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(Command $command): CommandResponse
    {
        $commandClass = get_class($command);
        $handler = $this->handlers[$commandClass];

        if ($handler === null) {
            throw new \LogicException("Handler for command $commandClass not found");
        }

        return $handler->handle($command);
    }
}
