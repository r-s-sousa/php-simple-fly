<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Exceptions\NotImplementedException;

class Stream implements StreamInterface
{
    public function __toString(): string {
        throw new NotImplementedException(__METHOD__);
    }

    public function close(): void {
        throw new NotImplementedException(__METHOD__);
    }

    public function detach() {
        throw new NotImplementedException(__METHOD__);
    }

    public function getSize(): ?int {
        throw new NotImplementedException(__METHOD__);
    }

    public function tell(): int {
        throw new NotImplementedException(__METHOD__);
    }

    public function eof(): bool {
        throw new NotImplementedException(__METHOD__);
    }

    public function isSeekable(): bool {
        throw new NotImplementedException(__METHOD__);
    }

    public function seek(int $offset, int $whence = SEEK_SET): void {
        throw new NotImplementedException(__METHOD__);
    }

    public function rewind(): void {
        throw new NotImplementedException(__METHOD__);
    }

    public function isWritable(): bool {
        throw new NotImplementedException(__METHOD__);
    }

    public function write(string $string): int {
        throw new NotImplementedException(__METHOD__);
    }

    public function isReadable(): bool {
        throw new NotImplementedException(__METHOD__);
    }

    public function read(int $length): string {
        throw new NotImplementedException(__METHOD__);
    }

    public function getContents(): string {
        throw new NotImplementedException(__METHOD__);
    }

    public function getMetadata(?string $key = null) {
        throw new NotImplementedException(__METHOD__);
    }
}
