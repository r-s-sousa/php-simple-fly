<?php

namespace SimpleFly\Http\Interfaces\Middlewares;

use SimpleFly\Http\Interfaces\ResponseInterface;
use SimpleFly\Http\Interfaces\ServerRequestInterface;

interface RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface;
}
