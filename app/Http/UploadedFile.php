<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Exceptions\NotImplementedException;
use SimpleFly\Http\Interfaces\UploadedFileInterface;

class UploadedFile implements UploadedFileInterface
{
    public function getStream(): StreamInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function moveTo(string $targetPath): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getSize(): ?int
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getError(): int
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getClientFilename(): ?string
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getClientMediaType(): ?string
    {
        throw new NotImplementedException(__METHOD__);
    }
}
