<?php

namespace App;

use App\Abstract\Provider;

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
        foreach (req('config.providers') as $service) {
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
