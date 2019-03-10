<?php


namespace App\Core\DDD\Command;

/**
 * Interface CommandBusMiddleware
 *
 * @package App\Core\DDD\Command
 */
interface CommandBusMiddleware
{
    public function setNextBus(CommandBusMiddleware $next): self;
    public function dispatch(Command $command): CommandResponse;
}
