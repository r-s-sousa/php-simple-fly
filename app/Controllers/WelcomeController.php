<?php

namespace SimpleFly\Controllers;

use SimpleFly\Http\Controller;
use SimpleFly\Http\Interfaces\RequestInterface as Request;
use SimpleFly\Http\Interfaces\ResponseInterface as Response;

class WelcomeController extends Controller
{
    public function index(string $request, string $response)
    {
        return ['type' => 'controller', 'request' => $request, 'response' => $response];
    }
}
