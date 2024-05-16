<?php

namespace SimpleFly\Core;

use Closure;
use SimpleFly\Enums\HandlerType;
use SimpleFly\Enums\RouteMethod;

class Route
{
    private $handleType;

    public function __construct(
        readonly RouteMethod $method,
        readonly string $uri,
        readonly Closure|array|string $handler,
        readonly string $name
    ) {
        $this->setHandleType();
    }

    public function setHandleType()
    {
        if (is_string($this->handler)) {
            $this->handleType = HandlerType::INVOKABLE;
        } elseif (is_array($this->handler)) {
            $this->handleType = HandlerType::CONTROLLER;
        } elseif ($this->handler instanceof Closure) {
            $this->handleType = HandlerType::CLOSURE;
        } else {
            throw new \InvalidArgumentException('Invalid handler type');
        }
    }

    public function assocArray()
    {
        return [
            'method' => $this->method,
            'uri' => $this->uri,
            'handler' => $this->handler,
            'handlerType' => $this->handleType,
            'name' => $this->name
        ];
    }
}
