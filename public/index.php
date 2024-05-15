<?php

use SimpleFly\Router;

require_once __DIR__ . '/../vendor/autoload.php';

Router::get('/', function () {
    return 'hellow world!';
});

Router::post('/', function () {
    return 'hellow world!';
});
