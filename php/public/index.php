<?php

use BlankFramework\FilePathRouter\FilePathRouter;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $router = new FilePathRouter(__DIR__ . '/../routes');
    $router->routeRequest();
}
