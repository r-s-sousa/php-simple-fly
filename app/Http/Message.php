<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Http\Interfaces\MessageInterface;

class Message implements MessageInterface
{
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

    public function withBody(\Psr\Http\Message\StreamInterface $body): MessageInterface
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
