<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\UriInterface;
use SimpleFly\Exceptions\NotImplementedException;

class Uri implements UriInterface
{
    public function getScheme(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getAuthority(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getUserInfo(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getHost(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getPort(): ?int
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getPath(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getQuery(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getFragment(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withScheme(string $scheme): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withUserInfo(string $user, ?string $password = null): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withHost(string $host): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withPort(?int $port): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withPath(string $path): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withQuery(string $query): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withFragment(string $fragment): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function __toString(): string
    {
        throw new NotImplementedException(__METHOD__);
    }
}
