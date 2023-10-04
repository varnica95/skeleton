<?php

namespace App\Abstract\EventDispatcher;

use App\Trait\DependencyInjectionTrait;

abstract class Listener
{
    use DependencyInjectionTrait;

    abstract public function handle(Event $event): void;
}
