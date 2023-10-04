<?php

namespace App\Trait;

use App\Helper\Cache;
use App\Helper\Reflection;
use ReflectionParameter;

trait DependencyInjectionTrait
{
    /**
     * @throws \ReflectionException
     */
    private function getArguments(string $class, string $method = '__construct'): array
    {
        $arguments = [];
        $parameters = Reflection::getParameters($class, $method);
        $binds = req('config.binds');

        /** @var ReflectionParameter $parameter */
        foreach ($parameters as $parameter) {
            $typeName = Reflection::getTypeName($parameter);

            if (in_array($typeName, ['int', 'string', 'bool'])) {
                $bind = $binds[$parameter->getName()] ?? null;
                $arguments[$typeName] = $bind ?? $parameter->getDefaultValue();

                continue;
            }

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
