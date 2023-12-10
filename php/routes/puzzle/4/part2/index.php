<?php

use Adrian\AdventOfCode2023\Solver\Four\Part2;

$solver = new Part2();

$testSolution = $solver->processFile(__DIR__ . '/test.txt');

echo sprintf('<p>%s</p>', $testSolution);

$solution = $solver->processFile(__DIR__ . '/input.txt');

echo sprintf('<p>%s</p>', $solution);
