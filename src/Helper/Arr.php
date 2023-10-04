<?php

namespace App\Helper;

class Arr
{
    public static function dot(array $array, array $n = [], string $root = ''): array
    {
        foreach ($array as $key => $value) {
            if (!is_array($value)) {
                $n[$root.$key] = $value;
                continue;
            }

            $n = array_merge($n, static::dot($value, $n, $root.$key.'.'));
        }

        return $n;
    }
}
