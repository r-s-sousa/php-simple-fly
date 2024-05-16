<?php

namespace SimpleFly\Exceptions;

use SimpleFly\Enums\HttpResponseCode;

class NotImplementedException extends RouterException
{
    public function __construct(string $methodName)
    {
        parent::__construct("Method {$methodName} is not implemented", HttpResponseCode::NOT_IMPLEMENTED->value);
    }
}
