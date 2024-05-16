<?php

namespace SimpleFly\Enums;

use SimpleFly\Exceptions\RouterException;

enum RouteMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';

    public static function fromString(string $method): self
    {
        return match (strtoupper($method)) {
            self::GET->value => self::GET,
            self::POST->value => self::POST,
            self::PUT->value => self::PUT,
            self::PATCH->value => self::PATCH,
            self::DELETE->value => self::DELETE,
            default => throw new RouterException("Invalid method: {$method}")
        };
    }

    public static function toString(RouteMethod $method): string
    {
        return $method->value;
    }
}
