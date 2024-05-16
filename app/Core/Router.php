<?php

namespace SimpleFly\Core;

use SimpleFly\Enums\RouteMethod;

class Router
{
    private static $routes = [];

    private static function addRoute($method, $uri, $handler, $name = '')
    {
        $route = new Route($method, $uri, $handler, $name);
        self::$routes['obj'][] = $route;
        self::$routes['assoc'][] = $route->assocArray();
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function get($uri, $handler, $name = '')
    {
        self::addRoute(RouteMethod::GET, $uri, $handler, $name);
    }

    public static function post($uri, $handler, $name = '')
    {
        self::addRoute(RouteMethod::POST, $uri, $handler, $name);
    }

    public static function put($uri, $handler, $name = '')
    {
        self::addRoute(RouteMethod::PUT, $uri, $handler, $name);
    }

    public static function patch($uri, $handler, $name = '')
    {
        self::addRoute(RouteMethod::PATCH, $uri, $handler, $name);
    }

    public static function delete($uri, $handler, $name = '')
    {
        self::addRoute(RouteMethod::DELETE, $uri, $handler, $name);
    }
}
