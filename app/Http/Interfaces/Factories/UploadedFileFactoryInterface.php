<?php

namespace SimpleFly\Http\Interfaces\Factories;

use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Http\Interfaces\UploadedFileInterface;

interface UploadedFileFactoryInterface
{
    public function createUploadedFile(
        StreamInterface $stream,
        ?int $size = null,
        int $error = \UPLOAD_ERR_OK,
        ?string $clientFilename = null,
        ?string $clientMediaType = null
    ): UploadedFileInterface;
}
