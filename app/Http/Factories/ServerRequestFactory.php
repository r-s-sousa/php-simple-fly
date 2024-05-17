<?php

namespace SimpleFly\Http\Factories;

use SimpleFly\Http\Interfaces\Factories\ServerRequestFactoryInterface;
use SimpleFly\Http\Interfaces\UriInterface;
use SimpleFly\Exceptions\NotImplementedException;
use SimpleFly\Http\Interfaces\ServerRequestInterface;

class ServerRequestFactory implements ServerRequestFactoryInterface
{
    public function createServerRequest(string $method, UriInterface $uri, array $serverParams = []): ServerRequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
