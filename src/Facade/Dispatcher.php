<?php

namespace App\Facade;

use App\Abstract\EventDispatcher\Dispatcher as MainDispatcher;
use App\Abstract\Facade;

/**
 * @method static addListener(string $event, string $listener)
 * @method static addListeners(string $event, array $listeners)
 * @method static dispatch(string $event)
 */
class Dispatcher extends Facade
{
    public static function getService(): MainDispatcher
    {
        /** @var MainDispatcher $service */
        $service = self::$container->get(MainDispatcher::class);

        return $service;
    }
}
