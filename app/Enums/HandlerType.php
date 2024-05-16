<?php

namespace SimpleFly\Enums;

enum HandlerType
{
    case CLOSURE;
    case CONTROLLER;
    case INVOKABLE;
}
