<?php


namespace App\Core\DDD\Command;

/**
 * Interface CommandHandler
 *
 * @package App\Core\DDD\Command
 */
interface CommandHandler
{
    function handle(Command $command): CommandResponse;

    function listenTo(): string;
}
