<?php
/**
 * Created by PhpStorm.
 * User: ptipe
 * Date: 10/03/2019
 * Time: 16:26
 */

namespace App\Core\Infrastructure\Middleware;

use App\Core\DDD\Command\Command;
use App\Core\DDD\Command\CommandBusMiddleware;
use App\Core\DDD\Command\CommandResponse;
use App\Core\Infrastructure\CommandBus;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DoctrineFlushBusMiddleware
 * @package App\Core\Infrastructure\Middleware
 */
class DoctrineFlushBusMiddleware extends CommandBus implements CommandBusMiddleware
{
    /**
     * @var CommandBusMiddleware
     */
    private $next;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    function setNextBus(CommandBusMiddleware $next): CommandBusMiddleware
    {
        $this->next = $next;

        return $this;
    }

    function dispatch(Command $command): CommandResponse
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $response = $this->next->dispatch($command);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            $response = new CommandResponse(null, 500);
        }

        return $response;
    }
}