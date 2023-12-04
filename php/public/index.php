<?php

use BlankFramework\FilePathRouter\FilePathRouter;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

try {
    $router = new FilePathRouter(__DIR__ . '/../routes');
    $route = $router->routeRequest($request->getPathInfo());
    include_once $route;
} catch (\Throwable $throwable) {
    echo $throwable->getMessage();
}
