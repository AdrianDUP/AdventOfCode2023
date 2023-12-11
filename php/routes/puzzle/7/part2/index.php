<?php

use Adrian\AdventOfCode2023\Solver\Seven\Part2;

$solver = new Part2();

$solution = $solver->processFile(__DIR__ . '/test.txt');

printf('<p>%s</p>', $solution);

$solution = $solver->processFile(__DIR__ . '/input.txt');

printf('<p>%s</p>', $solution);

echo 'Testing';
