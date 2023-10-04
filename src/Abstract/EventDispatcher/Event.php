<?php

namespace App\Abstract\EventDispatcher;

abstract class Event
{
    public function getName(): string
    {
        return get_class($this);
    }
}
