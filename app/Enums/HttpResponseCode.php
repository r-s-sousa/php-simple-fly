<?php

namespace SimpleFly\Enums;

use SimpleFly\Exceptions\RouterException;

enum HttpResponseCode: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
    case NOT_AUTHORIZED = 401;
    case NOT_FOUND = 404;
    case NOT_PROCESSED = 422;
    case NOT_IMPLEMENTED = 500;

    public static function fromInt(int $code): self
    {
        return match ($code) {
            self::OK->value => self::OK,
            self::CREATED->value => self::CREATED,
            self::NO_CONTENT->value => self::NO_CONTENT,
            self::NOT_AUTHORIZED->value => self::NOT_AUTHORIZED,
            self::NOT_FOUND->value => self::NOT_FOUND,
            self::NOT_PROCESSED->value => self::NOT_PROCESSED,
            self::NOT_IMPLEMENTED->value => self::NOT_IMPLEMENTED,
            default => throw new RouterException("Invalid HTTP response code: {$code}"),
        };
    }

    public function toString(): string
    {
        return (string)$this->value;
    }
}
