### Route pattern match

```php
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
```

## important data

```php

    // most important headers
    $contentType = $_SERVER['CONTENT_TYPE'];
    $contentLenght = $_SERVER['CONTENT_LENGTH'];
    $accept = $_SERVER['HTTP_ACCEPT'];
    $origin = $_SERVER['REMOTE_ADDR'];
    $headers = getallheaders();

    // content of the request
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    $queryString = $_SERVER['QUERY_STRING'];
    $body = json_decode(file_get_contents('php://input'));
```
