<?php

namespace App\Helper;

class Reflection
{
    public static function getParameters(string $class, string $method): array
    {
        /** @var class-string $classString */
        $classString = $class;

        try {
            $reflectionClass = new \ReflectionClass($classString);
            $reflectionMethod = $reflectionClass->getMethod($method);
        } catch (\ReflectionException $exception) {
            return [];
        }

        return $reflectionMethod->getParameters();
    }

    public static function getTypeName(\ReflectionParameter $parameter): string
    {
        /** @var \ReflectionNamedType $type */
        $type = $parameter->getType();

        return $type->getName();
    }
}
