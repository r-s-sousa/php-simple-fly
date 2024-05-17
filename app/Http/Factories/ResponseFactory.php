<?php

namespace SimpleFly\Http\Factories;

use SimpleFly\Http\Interfaces\ResponseInterface;
use SimpleFly\Exceptions\NotImplementedException;
use SimpleFly\Http\Interfaces\Factories\ResponseFactoryInterface;

class ResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
