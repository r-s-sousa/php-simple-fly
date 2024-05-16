<?php

use SimpleFly\Core\Router;
use SimpleFly\Controllers\WelcomeController;
use SimpleFly\Controllers\InvokableController;

require_once __DIR__ . '/../vendor/autoload.php';

$closure = function ($request, $response) {
    return ['type' => 'closure', 'request' => $request, 'response' => $response];
};

Router::get('/', $closure, 'get.home');
Router::get('/closure', $closure, 'delete.home');
Router::get('/invokable', InvokableController::class, 'delete.home');
Router::get('/controller', [WelcomeController::class, 'index'], 'delete.home');

run();
