<?php

namespace SimpleFly\Http\Factories;

use SimpleFly\Http\Interfaces\Factories\UriFactoryInterface;
use SimpleFly\Http\Interfaces\UriInterface;
use SimpleFly\Exceptions\NotImplementedException;

class UriFactory implements UriFactoryInterface
{
    public function createUri(string $uri = ''): UriInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
