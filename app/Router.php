<?php

namespace SimpleFly;

class Router
{
    private static $routes = [];

    private static function addRoute($method, $uri, $handler, $name = '')
    {
        self::$routes[] = new Route($method, $uri, $handler, $name);
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
