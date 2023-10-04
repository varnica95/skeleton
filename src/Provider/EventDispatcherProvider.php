<?php

namespace App\Provider;

use App\Abstract\EventDispatcher\Dispatcher;
use App\Abstract\Provider;
use App\EventDispatcher\Event\HandlerEvent;
use App\EventDispatcher\Listener\HandlerListener;
use App\Trait\Facade\EventDispatcherFacadeTrait;

class EventDispatcherProvider extends Provider
{
    use EventDispatcherFacadeTrait;

    public function __construct(private readonly Dispatcher $dispatcher)
    {
    }

    private static array $eventListeners = [
        HandlerEvent::class => [
            HandlerListener::class
        ]
    ];

    public function register(): void
    {
        foreach (self::$eventListeners as $event => $listeners) {
            $this->dispatcher->addListeners($event, $listeners);
        }
    }
}
