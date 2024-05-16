<?php

use SimpleFly\Core\Router;
use SimpleFly\Enums\HandlerType;
use SimpleFly\Enums\HttpResponseCode;
use SimpleFly\Enums\RouteMethod;
use SimpleFly\Exceptions\RouterException;

function ddJson(...$args): void
{
    $json = json_encode(...$args);
    header('Content-Type: application/json');
    die($json);
}

function dd(...$args): void
{
    die(var_dump(...$args));
}

/** @throws RouterException */
function route(string $name): array
{
    $routes = routes();

    foreach ($routes as $route) {
        if (empty($route['name'])) {
            continue;
        }
        if ($route['name'] === $name) {
            return $route;
        }
    }

    throw new RouterException(
        "Route find by name not found with name: {$name}",
        HttpResponseCode::NOT_FOUND->value
    );
}

function listRoutesGroupByUri(): array
{
    $routes = routes();
    $lineRoutes = [];

    foreach ($routes as $route) {
        $lineRoutes[$route['uri']][] = RouteMethod::toString($route['method']);
    }

    return $lineRoutes;
}

function routeAllowedMethods(array $matches): array
{
    $allowedMethods = [];

    foreach ($matches as $match) {
        $allowedMethods[] = RouteMethod::toString($match['method']);
    }

    return $allowedMethods;
}

/** @throws RouterException */
function searchRoute(string $method, string $uri, array $routes): array
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

function query(): array
{
    return $_GET;
}

function queryParam(string $param): array
{
    return query()[$param];
}

function uri(): string
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

function uriMatch(string $uri, array $routes): array
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

/** @throws RouterException */
function body(): array
{
    $bodyContent = file_get_contents('php://input');

    if (empty($bodyContent)) {
        return [];
    }

    $decodedBody = json_decode($bodyContent, true);

    if ($decodedBody === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new RouterException('Invalid JSON: ' . json_last_error_msg());
    }

    return $decodedBody;
}

function bodyParam(string $param): string|array
{
    return body()[$param];
}

function method(): string
{
    return $_SERVER['REQUEST_METHOD'];
}

function headers(): array
{
    return getallheaders();
}

function routes(): array
{
    return Router::getRoutes()['assoc'];
}

/** @throws RouterException|Exception */
function checkRoutesIntegrity(): void
{
    verifyIfHasDuplicatedRouteInRoutes();
    verifyIfHandlerFileAndMethodExists();
    verifyIfHasDuplicatedNameInRoutes();
}

/** @throws RouterException */
function verifyIfHasDuplicatedRouteInRoutes(): void
{
    $routeList = listRoutesGroupByUri();

    foreach ($routeList as $uri => $methods) {
        $methodsWithCount = array_count_values($methods);
        foreach ($methodsWithCount as $method => $count) {
            if ($count > 1) {
                throw new RouterException("Route uri: {$uri} has duplicated method: {$method}");
            }
        }
    }
}

/** @throws RouterException|Exception */
function verifyIfHandlerFileAndMethodExists(): void
{
    $routes = routes();

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

/** @throws RouterException */
function verifyIfHasDuplicatedNameInRoutes(): void
{
    $routes = routes();
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
}

function run(): void
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

function processRequest(): void
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

    // make the parameters to be passed
    // ...

    // call function
    $result = runHandler($handler, $handlerType);

    ddJson($result);
}

function runHandler($handler, $handlerType)
{
    [$request, $response] = ['req', 'res'];

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
