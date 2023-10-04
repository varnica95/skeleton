<?php

namespace App;

use App\Abstract\Provider;
use App\Provider\EventDispatcherProvider;

class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();

        $this->registerProviders();
    }

    private function registerProviders(): void
    {
        // list of all providers which will be registered
        $providers = [
            EventDispatcherProvider::class,
        ];

        foreach ($providers as $service) {
            /** @var Provider $provider */
            $provider = $this->getService($service);
            $provider->register();
        }
    }

    private function getService(string $key): ?object
    {
        return $this->container->get($key);
    }

    public function run(): void
    {
    }
}
