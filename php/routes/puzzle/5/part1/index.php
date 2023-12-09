<?php

use Adrian\AdventOfCode2023\Solver\Five\PartOne;

$solver = new PartOne();

try {
    $testPart1 = $solver->processFile(__DIR__ . '/test1.txt');
    echo sprintf('<p>%s</p>', $testPart1);
} catch (\Throwable $throwable) {
    echo print_r($throwable->getMessage());
}

$solution1 = $solver->processFile(__DIR__ . '/input.txt');

echo sprintf('<p>%s</p>', $solution1);
