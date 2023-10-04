<?php

namespace App\Abstract;

use App\Container;

abstract class Facade
{
    protected static Container $container;

    abstract public static function getService(): object;

    public static function setContainer(Container $container): void
    {
        self::$container = $container;
    }

    public static function __callStatic(string $name, array $arguments): mixed
    {
        $instance = static::getService();

        $instance->{$name}(...$arguments);

        return $instance;
    }
}
