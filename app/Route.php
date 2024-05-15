<?php

namespace SimpleFly;

use Closure;

class Route
{
    public function __construct(
        readonly RouteMethod $method,
        readonly string $uri,
        readonly Closure|array $handler,
        readonly string $name
    ) {
    }
}
