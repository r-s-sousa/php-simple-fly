<?php

namespace SimpleFly\Http\Factories;

use SimpleFly\Exceptions\NotImplementedException;
use SimpleFly\Http\Interfaces\Factories\RequestFactoryInterface;
use SimpleFly\Http\Interfaces\UriInterface;
use SimpleFly\Http\Interfaces\RequestInterface;

class RequestFactory implements RequestFactoryInterface
{
    public function createRequest(string $method, UriInterface|string $uri): RequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
