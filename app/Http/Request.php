<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Http\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    public function getMethod(): string
    {
    }

    public function getRequestTarget(): string
    {
    }

    public function getUri(): UriInterface
    {
    }

    public function withMethod(string $method): RequestInterface
    {
    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
    }

    public function getBody(): StreamInterface
    {
    }

    public function getHeader(string $name): array
    {
    }

    public function getHeaderLine(string $name): string
    {
    }

    public function getHeaders(): array
    {
    }

    public function getProtocolVersion(): string
    {
    }

    public function hasHeader(string $name): bool
    {
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
    }

    public function withHeader(string $name, $value): MessageInterface
    {
    }

    public function withoutHeader(string $name): MessageInterface
    {
    }

    public function withProtocolVersion(string $version): MessageInterface
    {
    }
}
