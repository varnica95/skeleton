<?php

namespace App\Helper;

class Cache
{
    private static array $items = [];

    public static function save(string $key, mixed $value): void
    {
        if (!self::has($key)) {
            self::$items[$key] = $value;
        }
    }

    public static function get(string $key): mixed
    {
        return self::$items[$key] ?? null;
    }

    public static function has(string $key): bool
    {
        return isset(self::$items[$key]);
    }

    public static function clear(): void
    {
        self::$items = [];
    }
}
