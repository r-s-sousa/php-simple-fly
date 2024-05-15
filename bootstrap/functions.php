<?php

function ddJson(...$args)
{
    $json = json_encode(...$args);
    header('Content-Type: application/json');
    die($json);
}

function dd(...$args)
{
    die(var_dump(...$args));
}

function route(string $name)
{
}

function routeExists(string $name)
{
}

function query()
{
    return $_GET;
}

function queryParam($param)
{
    return query()[$param];
}

function uri()
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

function uriMatch()
{
    $routes = routes();
    $uri = uri();

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

            return [
                'uri' => $uri,
                'route' => $route,
                'params' => $params
            ];
        }
    }

    return [
        'uri' => $uri,
        'route' => 'route not found for provided uri: ' . $uri,
        'params' => []
    ];
}

function body()
{
    $bodyContent = file_get_contents('php://input');

    if (empty($bodyContent)) {
        return null;
    }

    if (function_exists('json_validate')) {
        if (!json_validate($bodyContent)) {
            throw new Exception('Invalid JSON');
        }
    }

    return json_decode($bodyContent, true);
}

function bodyParam($param)
{
    return body()[$param];
}

function method()
{
    return $_SERVER['REQUEST_METHOD'];
}

function headers()
{
    return getallheaders();
}

function routes()
{
    $routes = [
        '/users',
        '/users/{name}',
        '/users/{name}/edit',
        '/users/{name}/show',
        '/users/bulk/insert',
        '/users/fullname/{firstname}/{lastname}',
    ];

    return $routes;
}

ddJson(
    body()
);
