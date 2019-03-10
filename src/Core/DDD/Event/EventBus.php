<?php


namespace App\Core\DDD\Event;

/**
 * Interface EventBus
 *
 * @package App\Core\DDD\Event
 */
interface EventBus
{
    /**
     * @param Event $event
     */
    public function dispatch(Event $event): void;
}
