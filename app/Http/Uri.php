<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\UriInterface;

class Uri implements UriInterface
{
    public function getAuthority(): string
    {
    }

    public function getFragment(): string
    {
    }

    public function getHost(): string
    {
    }

    public function getPath(): string
    {
    }

    public function getPort(): int|null
    {
    }

    public function getQuery(): string
    {
    }

    public function getScheme(): string
    {
    }

    public function getUserInfo(): string
    {
    }

    public function withFragment(string $fragment): UriInterface
    {
    }

    public function withHost(string $host): UriInterface
    {
    }

    public function withPath(string $path): UriInterface
    {
    }

    public function withPort(int|null $port): UriInterface
    {
    }

    public function withQuery(string $query): UriInterface
    {
    }

    public function withScheme(string $scheme): UriInterface
    {
    }

    public function withUserInfo(string $user, string|null $password = null): UriInterface
    {
    }

    public function __toString(): string
    {
    }
}
