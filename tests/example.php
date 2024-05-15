<?php

use function PHPSTORM_META\map;

$routes = [
    '/users',
    '/users/{name}',
    '/users/{name}/edit',
    '/users/{name}/show',
    '/users/bulk/insert',
    '/users/fullname/{firstname}/{lastname}',
];

$uris = [
    '/users',
    '/users/rafael',
    '/users/rafael/edit',
    '/users/rafael/show',
    '/users/bulk/insert',
    '/users/fullname/rafael/sousa'
];

$matches = [];
foreach ($uris as $uri) {
    $matches[] = findRoute($routes, $uri);
}

echo(json_encode($matches));

function findRoute($uri, $routes = [])
{
    $routes = routes();

    $match = [null, null];

    foreach ($routes as $route) {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>\w+)', $route);
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';

        if (preg_match($pattern, $uri, $matches)) {
            $params = [];
            if (preg_match_all('/\{(\w+)\}/', $route, $paramNames)) {
                foreach ($paramNames[1] as $paramName) {
                    $params[$paramName] = $matches[$paramName];
                }
            }

            $match = [$uri, $route, $params];
            break;
        }
    }

    return $match;
}
