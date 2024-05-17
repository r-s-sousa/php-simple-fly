<?php

namespace SimpleFly\Http\Interfaces\Factories;

use SimpleFly\Http\Interfaces\UriInterface;
use SimpleFly\Http\Interfaces\ServerRequestInterface;

interface ServerRequestFactoryInterface
{
    public function createServerRequest(string $method, UriInterface $uri, array $serverParams = []): ServerRequestInterface;
}
