<?php

if (!function_exists('req')) {
    // Require content of a file to the array
    function req(string $path): array
    {
        return require_once sprintf('%s.php', $path);
    }
}