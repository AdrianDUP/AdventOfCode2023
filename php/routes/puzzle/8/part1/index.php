<?php

use Adrian\AdventOfCode2023\Solver\Eight\Part1;

$solver = new Part1();

$solution = $solver->processFile(__DIR__ . '/test.txt');

printSolution($solution);

$solution = $solver->processFile(__DIR__ . '/test2.txt');

printSolution($solution);

$solution = $solver->processFile(__DIR__ . '/input.txt');

printSolution($solution);
