<?php

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