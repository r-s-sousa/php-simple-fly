<?php

namespace SimpleFly\Http\Interfaces\Middlewares;

use SimpleFly\Http\Interfaces\ResponseInterface;
use SimpleFly\Http\Interfaces\ServerRequestInterface;

interface MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface;
}
