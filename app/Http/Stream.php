<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\StreamInterface;

class Stream implements StreamInterface
{
    public function close(): void
    {
    }

    public function detach()
    {
    }

    public function eof(): bool
    {
    }

    public function getContents(): string
    {
    }

    public function getMetadata(string|null $key = null)
    {
    }

    public function getSize(): int|null
    {
    }

    public function isReadable(): bool
    {
    }

    public function isSeekable(): bool
    {
    }

    public function isWritable(): bool
    {
    }

    public function read(int $length): string
    {
    }

    public function rewind(): void
    {
    }

    public function seek(int $offset, int $whence = SEEK_SET): void
    {
    }

    public function tell(): int
    {
    }

    public function write(string $string): int
    {
    }

    public function __toString(): string
    {
    }
}
