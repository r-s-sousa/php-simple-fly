<?php

use SimpleFly\Core\Router;
use SimpleFly\Controllers\WelcomeController;
use SimpleFly\Controllers\InvokableController;

require_once __DIR__ . '/../vendor/autoload.php';

$closure = function ($request, $response) {
    return ['type' => 'closure', 'request' => $request, 'response' => $response];
};

Router::get('/', $closure);
Router::get('/closure', $closure, 'home.closure');
Router::get('/invokable', InvokableController::class, 'home.invokable');
Router::get('/controller', [WelcomeController::class, 'index'], 'home.controller');

run();
