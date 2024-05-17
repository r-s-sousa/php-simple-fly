<?php

namespace SimpleFly\Http\Factories;

use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Exceptions\NotImplementedException;
use SimpleFly\Http\Interfaces\Factories\UploadedFileFactoryInterface;
use SimpleFly\Http\Interfaces\UploadedFileInterface;

class UploadedFileFactory implements UploadedFileFactoryInterface
{
    public function createUploadedFile(
        StreamInterface $stream,
        ?int $size = null,
        int $error = \UPLOAD_ERR_OK,
        ?string $clientFilename = null,
        ?string $clientMediaType = null
    ): UploadedFileInterface{
        throw new NotImplementedException(__METHOD__);
    }
}
