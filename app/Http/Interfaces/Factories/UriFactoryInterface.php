<?php

namespace SimpleFly\Http\Interfaces\Factories;

use SimpleFly\Http\Interfaces\UriInterface;

interface UriFactoryInterface
{
    public function createUri(string $uri = ''): UriInterface;
}
