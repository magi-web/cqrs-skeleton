<?php

namespace App\Core\Infrastructure;


use App\Core\DDD\Command\Command;
use App\Core\DDD\Command\CommandBusMiddleware;
use App\Core\DDD\Command\CommandResponse;

/**
 * Class CommandBus
 *
 * @package App\Core\DDD
 */
abstract class CommandBus implements CommandBusMiddleware
{
    abstract public function dispatch(Command $command): CommandResponse;
}
