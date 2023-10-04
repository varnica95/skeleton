<?php

namespace App\Trait\Facade;

trait EventDispatcherFacadeTrait
{
    public function addListener(string $event, string $listener): void
    {
        $this->dispatcher->addListener($event, $listener);
    }

    public function addListeners(string $event, array $listeners): void
    {
        $this->dispatcher->addListeners($event, $listeners);
    }

    public function dispatch(string $event): void
    {
        $this->dispatcher->dispatch($event);
    }
}
