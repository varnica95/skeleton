<?php

use App\Helper\Arr;
use App\Helper\Cache;

if (!function_exists('req')) {
    // Require content of a file to the array
    function req(string $path): array
    {
        $path = str_replace('.','/', $path);
        $key = 'req.'.$path;

        $cachedItem = Cache::get($key);
        if (null !== $cachedItem) {
            return $cachedItem;
        }

        $required = require sprintf('%s.php', $path);
        Cache::save($key, $required);
        return $required;
    }
}

if (!function_exists('config')) {
    // Retrieve a config value
    function config(string $path): mixed
    {
        $path = str_replace('/', '.', $path);

        $cachedItem = Cache::get($path);
        if (null !== $cachedItem) {
            return $cachedItem;
        }

        $exploded = explode('.', $path);
        $configFile = $exploded[0];
        unset($exploded[0]);
        $valuePath = implode('.', $exploded);

        $required = req('config/'.$configFile);

        $value = Arr::dot($required)[$valuePath] ?? null;
        Cache::save($path, $value);

        return $value;
    }
}
