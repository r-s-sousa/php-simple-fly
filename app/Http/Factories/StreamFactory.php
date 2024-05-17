<?php

namespace SimpleFly\Http\Factories;

use SimpleFly\Http\Interfaces\Factories\StreamFactoryInterface;
use SimpleFly\Http\Interfaces\StreamInterface;
use SimpleFly\Exceptions\NotImplementedException;

class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
