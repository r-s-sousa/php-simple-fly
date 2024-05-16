<?php

namespace SimpleFly\Http;

use SimpleFly\Http\Interfaces\ResponseInterface;
use SimpleFly\Exceptions\NotImplementedException;

class Response extends Message implements ResponseInterface
{
    public function getStatusCode(): int
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getReasonPhrase(): string
    {
        throw new NotImplementedException(__METHOD__);
    }
}
