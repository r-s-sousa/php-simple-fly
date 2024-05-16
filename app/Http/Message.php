<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Http\Interfaces\MessageInterface;
use SimpleFly\Exceptions\NotImplementedException;

class Message implements MessageInterface
{
    public function getBody(): StreamInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getHeader(string $name): array
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getHeaderLine(string $name): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getHeaders(): array
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getProtocolVersion(): string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function hasHeader(string $name): bool
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withHeader(string $name, $value): MessageInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withoutHeader(string $name): MessageInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withProtocolVersion(string $version): MessageInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
