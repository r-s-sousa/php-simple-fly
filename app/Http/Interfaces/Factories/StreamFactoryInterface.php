<?php

namespace SimpleFly\Http\Interfaces\Factories;

use SimpleFly\Http\Interfaces\StreamInterface;

interface StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface;

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface;

    public function createStreamFromResource($resource): StreamInterface;
}
