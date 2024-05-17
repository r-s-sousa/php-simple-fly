<?php

namespace SimpleFly\Http\Interfaces\Factories;

use SimpleFly\Http\Interfaces\UriInterface;
use SimpleFly\Http\Interfaces\RequestInterface;

interface RequestFactoryInterface
{
    public function createRequest(string $method, UriInterface|string $uri): RequestInterface;
}
