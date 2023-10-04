<?php

namespace App\Trait;

use App\Helper\Cache;
use App\Helper\Reflection;
use ReflectionParameter;

trait DependencyInjectionTrait
{
    private function getArguments(string $class, string $method = '__construct'): array
    {
        $arguments = [];
        $parameters = Reflection::getParameters($class, $method);

        /** @var ReflectionParameter $parameter */
        foreach ($parameters as $parameter) {
            $typeName = Reflection::getTypeName($parameter);

            $instance = $this->injectAndRetrieve($typeName);
            $arguments[$typeName] = $instance;
        }

        return array_values($arguments);
    }

    private function injectAndRetrieve(string $name, string $method = '__construct'): object
    {
        $cache = Cache::get($name);

        /** @var object $object */
        $object = match ($cache) {
            null => new $name(...$this->getArguments($name, $method)),
            default => $cache
        };

        Cache::save($name, $object);

        return $object;
    }
}
