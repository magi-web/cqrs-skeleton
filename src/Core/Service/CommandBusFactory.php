<?php

declare(strict_types=1);

namespace App\Core\Service;


use App\Core\DDD\Command\CommandBusMiddleware;
use App\Core\DDD\Command\CommandBusDispatcher;
use App\Core\DDD\Command\CommandHandler;

/**
 * Class CommandBusFactory
 *
 * @package App\Service
 */
class CommandBusFactory
{
    /**
     * @param CommandHandler[] $handlers
     * @param CommandBusMiddleware[] $middlewares
     * @return CommandBusMiddleware
     */
    static function build(iterable $handlers, iterable $middlewares): CommandBusMiddleware
    {
        $bus = new CommandBusDispatcher($handlers);
        /** @var CommandBusMiddleware $middleware */
        foreach ($middlewares as $middleware) {
            $bus = $middleware->setNextBus($bus);
        }
        return $bus;
    }
}
