<?php

namespace SimpleFly\Http\Interfaces\Factories;

use SimpleFly\Http\Interfaces\ResponseInterface;

interface ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface;
}
