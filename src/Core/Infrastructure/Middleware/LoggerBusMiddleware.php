<?php

namespace App\Core\Infrastructure\Middleware;

use App\Core\DDD\Command\Command;
use App\Core\DDD\Command\CommandBusMiddleware;
use App\Core\DDD\Command\CommandResponse;
use App\Core\Infrastructure\CommandBus;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerMiddleware
 *
 * @package App\Core\Middleware
 */
class LoggerBusMiddleware extends CommandBus implements CommandBusMiddleware
{
    /**
     * @var CommandBusMiddleware
     */
    private $next;

    /**
     * @var LoggerInterface
     */
    private $logger;

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    function setNextBus(CommandBusMiddleware $next): CommandBusMiddleware
    {
        $this->next = $next;

        return $this;
    }

    function dispatch(Command $command): CommandResponse
    {
        $startTime = microtime(true);
        $response = $this->next->dispatch($command);
        $endTime = microtime(true);
        $elapsed = $endTime - $startTime;

        $message = "Command " . get_class($command) . " took: " . $elapsed;
        $this->logger->info($message);

        return $response;
    }
}
