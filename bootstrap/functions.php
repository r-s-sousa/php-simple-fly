<?php

use SimpleFly\Core\Router;
use SimpleFly\Enums\HandlerType;
use SimpleFly\Enums\HttpResponseCode;
use SimpleFly\Enums\RouteMethod;
use SimpleFly\Exceptions\RouterException;

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

function route($name)
{
}

function listRoutesGroupByUri()
{
    $routes = routes();
    $lineRoutes = [];

    foreach ($routes as $route) {
        $lineRoutes[$route['uri']][] = RouteMethod::toString($route['method']);
    }

    return $lineRoutes;
}

function routeAllowedMethods($matches)
{
    $allowedMethods = [];

    foreach ($matches as $match) {
        $allowedMethods[] = RouteMethod::toString($match['method']);
    }

    return $allowedMethods;
}

function searchRoute($method, $uri, $routes)
{
    define('MAX_MATCH_COUNT', 1);
    define('METHOD_NOT_ALLOWED_COUNT', 0);

    $matches = uriMatch($uri, $routes);
    $allowedMethods = routeAllowedMethods($matches);

    if (count($matches) === 0) {
        throw new RouterException("Route not found: {$uri}", HttpResponseCode::NOT_FOUND->value);
    }

    $countMatch = METHOD_NOT_ALLOWED_COUNT;

    foreach ($matches as $match) {
        if ($match['method'] === RouteMethod::fromString($method)) {
            $countMatch++;
        }
    }

    if ($countMatch === METHOD_NOT_ALLOWED_COUNT) {
        $allowedMethodsString = implode(', ', $allowedMethods);
        throw new RouterException(
            "Method: {$method} not allowed in: {$uri}. Allowed methods: [{$allowedMethodsString}]",
            HttpResponseCode::NOT_FOUND->value
        );
    }

    if ($countMatch > MAX_MATCH_COUNT) {
        throw new RouterException(
            "Multiple routes found to uri: {$uri}",
            HttpResponseCode::NOT_PROCESSED->value
        );
    }

    return array_shift($matches);
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

function uriMatch($uri, $routes)
{
    $matches = [];

    foreach ($routes as $route) {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>\w+)', $route['uri']);
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';

        if (!preg_match($pattern, $uri, $patternMatch)) {
            continue;
        }

        $uriParams = [];
        if (preg_match_all('/\{(\w+)\}/', $route['uri'], $paramNames)) {
            foreach ($paramNames[1] as $paramName) {
                $uriParams[$paramName] = $patternMatch[$paramName];
            }
        }

        $matches[] = [
            'route' => $route,
            'uriParams' => $uriParams,
            'method' => $route['method'],
        ];
    }

    return $matches;
}

function body()
{
    $bodyContent = file_get_contents('php://input');

    if (empty($bodyContent)) {
        return null;
    }

    $decodedBody = json_decode($bodyContent, true);

    if ($decodedBody === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new RouterException('Invalid JSON: ' . json_last_error_msg());
    }

    return $decodedBody;
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
    return Router::getRoutes()['assoc'];
}

function checkRoutesIntegrity()
{
    $routes = routes();
    verifyIfHasDuplicatedRouteInRoutes($routes);
    verifyIfHandlerFileAndMethodExists($routes);
    verifyIfHasDuplicatedNameInRoutes($routes);
}

function verifyIfHasDuplicatedRouteInRoutes(array $routes)
{
    $routeList = listRoutesGroupByUri();

    foreach ($routeList as $uri => $methods) {
        $methodCounts = array_count_values($methods);
        foreach ($methodCounts as $method => $count) {
            if ($count > 1) {
                throw new RouterException("Route uri: {$uri} with duplicated method: {$method}");
            }
        }
    }
}

function verifyIfHandlerFileAndMethodExists($routes)
{
    foreach ($routes as $route) {
        $type = $route['handlerType'];
        $handler = $route['handler'];

        if ($type === HandlerType::CLOSURE) {
            continue;
        }
        if ($type === HandlerType::CONTROLLER) {
            [$controller, $method] = $handler;
            $instance = new $controller();
            if (!method_exists($instance, $method)) {
                throw new RouterException("Method not found: {$controller}::{$method}");
            }
        } elseif ($type === HandlerType::INVOKABLE) {
            $instance = new $handler();
            $method = '__invoke';
            if (!method_exists($instance, $method)) {
                throw new RouterException("Method {$method} found in {$handler}");
            }
        }
    }
}

function verifyIfHasDuplicatedNameInRoutes($routes)
{
    $names = [];

    foreach ($routes as $route) {
        if (empty($route['name'])) {
            continue;
        }
        if (in_array($route['name'], $names)) {
            throw new RouterException("Route name must be unique: {$route['name']} already exists");
        }

        $names[] = $route['name'];
    }

    return false;
}

function run()
{
    try {
        checkRoutesIntegrity();
        processRequest();
    } catch (RouterException $e) {
        http_response_code($e->getCode());
        header('Content-Type: application/json');

        $errorResponse = [
            'error' => $e->getMessage(),
            'class' => RouterException::class
        ];

        echo json_encode($errorResponse);
    }
}

function processRequest()
{
    // identifiers
    $headers = headers();
    $method = method();
    $uri = uri();

    // routes
    $routes = routes();
    $match = searchRoute($method, $uri, $routes);

    // parameters
    $bodyParams = body();
    $queryParams = query();
    $uriParams = $match['uriParams'];
    $methodEnum = $match['method'];

    // process
    $route = $match['route'];
    $handler = $route['handler'];
    $handlerType = $route['handlerType'];

    // call function
    $result = runHandler($handler, $handlerType);

    ddJson($result);
}

function runHandler($handler, $handlerType)
{
    $request = 'req';
    $response = 'res';

    switch ($handlerType) {
        case HandlerType::CLOSURE:
            $closureResult = $handler($request, $response);
            return $closureResult;

        case HandlerType::CONTROLLER:
            [$controller, $method] = $handler;
            $instance = new $controller();
            $controllerResult = $instance->$method($request, $response);
            return $controllerResult;

        case HandlerType::INVOKABLE:
            $instance = new $handler();
            $invokableResult = $instance($request, $response);
            return $invokableResult;

        default:
            throw new InvalidArgumentException('Invalid handler type');
    }
}
