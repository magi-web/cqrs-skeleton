<?php

declare(strict_types=1);

namespace App\Core\DDD;


class NotImplmentedException extends \Exception
{
    protected $message = "Cette méthode n'est pas implémentée";
}
