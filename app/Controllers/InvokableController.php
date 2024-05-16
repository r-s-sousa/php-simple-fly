<?php

namespace SimpleFly\Controllers;

use SimpleFly\Http\Controller;
use SimpleFly\Http\Interfaces\RequestInterface as Request;
use SimpleFly\Http\Interfaces\ResponseInterface as Response;

class InvokableController extends Controller
{
    public function __invoke(string $request, string $response)
    {
        return ['type' => 'invokable', 'request' => $request, 'response' => $response];
    }
}
