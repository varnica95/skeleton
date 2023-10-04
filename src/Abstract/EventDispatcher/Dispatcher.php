<?php

namespace App\Abstract\EventDispatcher;

use App\Trait\DependencyInjectionTrait;

class Dispatcher
{
    use DependencyInjectionTrait;

    protected array $listeners = [];

    public function addListener(string $event, string $listener): void
    {
        $this->listeners[$event][] = $listener;
    }

    public function addListeners(string $event, array $listeners): void
    {
        $this->listeners[$event] = array_merge($this->listeners, $listeners);
    }

    public function dispatch(string $eventName): void
    {
        /** @var Event $event */
        $event = $this->injectAndRetrieve($eventName);
        $listeners = $this->listeners[$eventName] ?? [];

        foreach ($listeners as $listener) {
            /** @var Listener $instance */
            $instance = $this->injectAndRetrieve($listener);
            $instance->handle($event);
        }
    }

    public function dispatchAndReturn(Event $event): Event
    {
        $listeners = [];
        if (property_exists($event, 'listeners')) {
            $listeners = array_merge($listeners, $event->listeners);
        }

        $name = $event->getName();
        $this->addListeners($name, $listeners);
        $this->dispatch($name);

        return $event;
    }
}
