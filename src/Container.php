<?php

namespace App;

use App\Abstract\Facade;
use App\Trait\DependencyInjectionTrait;

class Container
{
    use DependencyInjectionTrait;

    private array $services = [];

    public function __construct()
    {
        // require all services
        foreach (req('config/services') as $service) {
            $this->services[$service] = $service;
        }

        // register a facade
        Facade::setContainer($this);
    }

    public function get(string $key): ?object
    {
        $service = $this->services[$key] ?? null;
        if (null === $service) {
            return null;
        }

        // Instantiate the object and save it to the cache
        return $this->injectAndRetrieve($service);
    }
}
