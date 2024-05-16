<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\UriInterface;
use SimpleFly\Http\Interfaces\RequestInterface;
use SimpleFly\Exceptions\NotImplementedException;

class Request extends Message implements RequestInterface
{
    public function getRequestTarget(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getMethod(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withMethod(string $method): RequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getUri(): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
