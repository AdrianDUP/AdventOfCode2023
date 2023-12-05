<?php

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

$logger = null;

if (!function_exists('logger')) {
    function logger(): LoggerInterface
    {
        global $logger;

        if (empty($logger)) {
            $logger = new Logger('file');
            $logger->pushHandler(new StreamHandler(__DIR__ . '/../storage/logs/app.log', Level::Debug));
        }

        return $logger;
    }
}

if (!function_exists('debug')) {
    function debug(string|\Stringable $message, array $context): void
    {
        logger()->debug($message, $context);
    }
}
