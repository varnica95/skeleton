<?php

namespace App\Abstract;

use App\Trait\DependencyInjectionTrait;

abstract class Provider
{
    use DependencyInjectionTrait;

    abstract public function register(): void;
}
