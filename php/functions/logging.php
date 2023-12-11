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
    function debug(string|\Stringable $message, array $context = []): void
    {
        logger()->debug($message, $context);
    }
}

if (!function_exists('info')) {
    function info(string|\Stringable $message, array $context = []): void
    {
        logger()->info($message, $context);
    }
}

function day7Sort($a, $b): int
{
    $aParts = str_split($a);
    $bParts = str_split($b);

    $uniqueA = array_unique($aParts);
    $uniqueB = array_unique($aParts);

    if (count($uniqueA) !== count($uniqueB)) {
        if (count($uniqueA) < count($uniqueB)) {
            return 1;
        } else {
            return -1;
        }
    }

    foreach ($aParts as $index => $card) {
        $bCard = $bParts[$index];
        if ($card == $bCard) {
            continue;
        }

        if ($card === 'A') {
            return 1;
        } else if ($bCard === 'A') {
            return -1;
        } else if ($card === 'K') {
            return 1;
        } else if ($bCard === 'K') {
            return -1;
        } else if ($card === 'Q') {
            return 1;
        } else if ($bCard === 'Q') {
            return -1;
        } else if ($card === 'J') {
            return 1;
        } else if ($bCard === 'J') {
            return -1;
        } else if ($card === 'T') {
            return 1;
        } else if ($bCard === 'T') {
            return -1;
        } else {
            return $card <=> $bCard;
        }            
    }
}
