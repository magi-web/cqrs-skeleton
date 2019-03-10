<?php


namespace App\Core\DDD\Event;

/**
 * Interface EventHandler
 *
 * @package App\Core\DDD\Event
 */
interface EventHandler
{
    function handle(Event $event): void;

    function listenTo(): string;
}
