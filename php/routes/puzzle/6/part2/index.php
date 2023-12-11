<?php

use Adrian\AdventOfCode2023\Solver\Six\Part2;

echo 'Working?';

$solver = new Part2();

$test = $solver->processFile(__DIR__ . '/test.txt');

echo sprintf('<p>%s</p>', $test);

$solution = $solver->processFile(__DIR__ . '/input.txt');

echo sprintf('<p>%s</p>', $solution);
